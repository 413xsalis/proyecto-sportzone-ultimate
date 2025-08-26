<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InstrucController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\PerfilAdminController;
use App\Http\Controllers\PerfilColabController;
use App\Http\Controllers\PerfilInstController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Colaborador\PagoController;
use App\Http\Controllers\ContactoController;


Route::resource('horarios', HorarioController::class);

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/instructor', [PerfilInstController::class, 'edit'])->name('perfilinst.edit');
    Route::put('/perfil/instructor', [PerfilInstController::class, 'update'])->name('perfilinst.update');
    Route::post('/perfil/instructor/upload-document', [PerfilInstController::class, 'uploadDocument'])->name('perfilinst.uploadDocument');
    Route::post('/perfil/instructor/upload-logo', [PerfilInstController::class, 'uploadLogo'])->name('perfilinst.uploadLogo');
    Route::post('/perfil/instructor/change-password', [PerfilInstController::class, 'changePassword'])->name('perfilinst.changePassword');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/colaborador', [PerfilColabController::class, 'edit'])->name('perfilcolab.edit');
    Route::put('/perfil/colaborador', [PerfilColabController::class, 'update'])->name('perfilcolab.update');
    Route::post('/perfil/colaborador/upload-document', [PerfilColabController::class, 'uploadDocument'])->name('perfilcolab.uploadDocument');
    Route::post('/perfil/colaborador/upload-logo', [PerfilColabController::class, 'uploadLogo'])->name('perfilcolab.uploadLogo');
    Route::post('/perfil/colaborador/change-password', [PerfilColabController::class, 'changePassword'])->name('perfilcolab.changePassword');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [PerfilAdminController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [PerfilAdminController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-document', [PerfilAdminController::class, 'uploadDocument'])->name('profile.uploadDocument');
    Route::post('/profile/upload-logo', [PerfilAdminController::class, 'uploadLogo'])->name('profile.uploadLogo');
    Route::post('/profile/change-password', [PerfilAdminController::class, 'changePassword'])->name('profile.changePassword');
});

// rutas del crud de gestion usuario--------------------------------------------------------//
Route::resource('usuario', UsuarioController::class);

// Rutas extra para la papelera (SoftDeletes)
Route::get('usuario/trashed', [UsuarioController::class, 'trashed'])
    ->name('usuario.trashed');

Route::post('usuario/{id}/restore', [UsuarioController::class, 'restore'])
    ->name('usuario.restore');

Route::delete('usuario/{id}/forceDelete', [UsuarioController::class, 'forceDelete'])
    ->name('usuario.forceDelete');

//--------------------------------------------------------------------------------------------------------------------//


// rutas de autenticacion-----------------------------------------------------------//

Auth::routes();

// Redirección principal según rol
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Rutas para administradores
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('administrador.admin.principal');
    })->name('admin.dashboard');

    Route::get('/gestion/trashed', [UsuarioController::class, 'trashed'])->name('usuario.trashed');

    // O si prefieres usar resource:
    Route::resource('dashboard', AdminController::class);
});
Route::middleware(['auth'])->group(function () {
    // Ruta para administradores
    Route::get('/admin/principal', function () {
        return view('administrador.admin.principal');
    })->name('admin.dashboard')->middleware('role:admin');

    // Ruta para colaboradores
    Route::get('/colaborador/principal', function () {
        return view('colaborador.inicio_colab.principal');
    })->name('colaborador.dashboard')->middleware('role:colaborador');

    // Ruta para instructores
    Route::get('/instructor/principal', function () {
        return view('instructor.inicio.principal');
    })->name('instructor.dashboard')->middleware('role:instructor');
});
// Rutas para colaboradores
Route::prefix('colaborador')->middleware(['auth', 'role:colaborador'])->group(function () {
    Route::get('/dashboard', function () {
        return view('colaborador.inicio_colab.principal');
    })->name('colaborador.dashboard');

    // O si prefieres usar resource:
    Route::resource('dashboard', ColaboradorController::class);
});

// Rutas para instructores
Route::prefix('instructor')->middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/dashboard', function () {
        return view('instructor.inicio.principal');
    })->name('instructor.dashboard');

    // O si prefieres usar resource:
    Route::resource('dashboard', InstrucController::class);
});
//---------------------------------------------------------------------------------------------------------------//


// rutas de vistas de admin----------------------------------------------------------------//
Route::prefix('admin')->group(function () {
    Route::get('/principal', [AdminController::class, 'principal'])->name('admin.principal');
});
Route::prefix('admin')->group(function () {
    Route::get('/gestion', [AdminController::class, 'gestion'])->name('admin.Gestion_usuarios');
});
Route::prefix('admin')->group(function () {
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
});
//---------------------------------------------------------------------------------------------------------------------------//





// ================= COLABORADOR =================
Route::prefix('colab')->group(function () {
    Route::get('/principal', [ColaboradorController::class, 'principal'])->name('colab.principal');
    Route::get('/gestion', [ColaboradorController::class, 'gestion'])->name('colab.gestion_clases');
    Route::get('/inscripcion', [ColaboradorController::class, 'inscripcion'])->name('colab.inscripcion');
    Route::get('/reportes', [ColaboradorController::class, 'reportes'])->name('colab.reportes');
    Route::get('/pagos', [ColaboradorController::class, 'pagos'])->name('colab.pagos');

});


// ================= INSTRUCTOR =================

Route::get('/instructores', [InstructorController::class, 'index'])->name('instructores.index');

// ================= HORARIOS =================


Route::delete('/horarios/{horario}', [HorarioController::class, 'destroy'])->name('horarios.destroy');
Route::get('/horarios/{id}/edit', [HorarioController::class, 'edit'])->name('horarios.edit');
Route::put('/horarios/{id}', [HorarioController::class, 'update'])->name('horarios.update');
Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
Route::post('/horarios', [HorarioController::class, 'store'])->name('horarios.store');
Route::get('/gestion-clases', [ColaboradorController::class, 'gestion'])->name('gestion.clases');
Route::put('/horarios/{horario}', [HorarioController::class, 'update'])->name('horarios.update');
Route::get('/horarios/create', [HorarioController::class, 'create'])->name('horarios.create');


// ================= ESTUDIANTES =================
Route::get('/inscripcion_estudiante', [EstudianteController::class, 'index'])->name('estudiantes.index');

Route::get('/estudiantes/create', [EstudianteController::class, 'create'])->name('estudiantes.create');

Route::post('/inscripcion_estudiante', [EstudianteController::class, 'store'])->name('estudiantes.store');

Route::get('/inscripcion_estudiante/{estudiante:documento}/edit', [EstudianteController::class, 'edit'])->name('estudiante.edit');

Route::put('/inscripcion_estudiante/{estudiante:documento}', [EstudianteController::class, 'update'])->name('estudiantes.update');

Route::delete('/inscripcion_estudiante/{estudiante:documento}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');






// ================= REPORTES =================
Route::get('/reportes/inscripciones', [ReporteController::class, 'reporteInscripciones'])->name('reportes.inscripciones');

// Reportes de Pagos (PDF y Excel)
Route::get('/reportes/pagos/pdf', [ReporteController::class, 'pagosPDF'])
    ->name('reportes.pagos');

Route::get('/reportes/pagos/excel', [ReporteController::class, 'pagosExcel'])
    ->name('reportes.pagos.excel');



// rutas de instructores //----------------------------//

    // INICIO

Route::prefix('inst')->group(function () {
    
    Route::get('/index', [InstrucController::class, 'index'])->name('inst.principal'); 

     // HORARIOS

    Route::get('/horario', [InstructorHorarioController::class, 'horario'])->name('inst.horarios'); //Muestra la tabla de horario del instructor.

    Route::get('/horario/actividades', [InstructorHorarioController::class, 'obtenerActividades'])->name('inst.horarios.actividades'); // Obtiene las actividades del horario en formato JSON para visualizarlas.

    Route::get('/horario/{instructorId?}', [InstructorHorarioController::class, 'horario'])->name('inst.horarios');

    Route::post('/horario/guardar', [InstructorHorarioController::class, 'guardarActividad'])->name('inst.horarios.guardar'); //Guarda una nueva actividad asignada a una celda del horario.

    Route::put('/horario/actualizar/{id}', [InstructorHorarioController::class, 'actualizarActividad'])->name('inst.horarios.actualizar'); //Actualiza una actividad existente, identificada por su ID.

    Route::delete('/horario/eliminar/{id}', [InstructorHorarioController::class, 'eliminarActividad'])->name('inst.horarios.eliminar'); //Elimina una actividad del horario.

    // ASISTENCIAS

    Route::get('/asistencia', [AsistenciaController::class, 'seleccionarGrupo'])->name('inst.asistencia'); //Muestra la página para seleccionar un grupo.

    Route::get('/asistencia/grupo/{nombre}', [AsistenciaController::class, 'tomarAsistenciaPorGrupo'])->name('asistencia.tomar.grupo'); //Permite tomar asistencia a un grupo específico por su nombre.

    Route::get('/asistencia/{grupo_id}', [AsistenciaController::class, 'verSubgrupos'])->name('asistencia.subgrupos'); //Muestra los subgrupos de un grupo seleccionado.

    Route::get('/asistencia/subgrupo/{id}', [AsistenciaController::class, 'tomarAsistenciaPorSubgrupo'])->name('asistencia.tomar.subgrupo'); //Permite tomar asistencia a un subgrupo en particular.

    Route::post('/asistencia/guardar', [AsistenciaController::class, 'guardar'])->name('asistencia.guardar'); //Guarda los registros de asistencia enviados por el formulario.

    // REPORTES

    Route::get('/reporte/asistencias', [InstructorReporteController::class, 'mostrarReporte'])->name('inst.reporte.asistencias');

    Route::post('/reporte/asistencias/pdf', [InstructorReporteController::class, 'generarAsistenciasPDF'])->name('inst.reporte.asistencias.pdf');
    
    Route::get('/subgrupos/{grupoId}', [InstructorReporteController::class, 'getSubgrupos'])->name('inst.get.subgrupos');
});
