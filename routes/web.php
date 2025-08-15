<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\InstrucController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\InstructorHorarioController;


Route::get('/', function () {
    return view('welcome');
});




// rutas del crud de gestion usuario--------------------------------------------------------//
Route::resource('usuario', UsuarioController::class)->names([
    'index' => 'usuario.index',
    'create' => 'usuario.create',
    'store' => 'usuario.store',
    'show' => 'usuario.show',
    'edit' => 'usuario.edit',
    'update' => 'usuario.update',
    'destroy' => 'usuario.destroy'
]);

// Ruta para usuarios inactivos
Route::get('usuario/inactivos', [UsuarioController::class, 'indexInactivos'])->name('usuarios.inactivos');

// Rutas adicionales para soft delete
Route::patch('usuario/{usuario}/restore', [UsuarioController::class, 'restore'])->name('usuario.restore');
Route::delete('usuario/{usuario}/force-delete', [UsuarioController::class, 'forceDelete'])->name('usuario.force-delete');
//--------------------------------------------------------------------------------------------------------------------//


// rutas de autenticacion-----------------------------------------------------------//

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('admin/dashboard', AdminController::class)
    ->middleware(['auth', 'role:admin']);
// Route::resource('editor/dashboard', EditorController::class)
// ->middleware(['auth','role:editor']);
Route::resource('colaborador/dashboard', ColaboradorController::class)
    ->middleware(['auth', 'role:colaborador']);

Route::resource('instructor/dashboard', InstrucController::class)
    ->middleware(['auth', 'role:instructor']);

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/principal', function () {
        return view('administrador.admin.principal');
    })->name('admin.dashboard')->middleware('role:administrador');


    Route::get('/colaborador/principal', function () {
        return view('colaborador.inicio_colab.principal');
    })->name('colaborador.dashboard')->middleware('role:colaborador');

    Route::get('/instructor/principal', function () {
        return view('instructor.inicio.principal');
    })->name('instructor.dashboard')->middleware('role:instructor');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
    Route::get('/formulario', [AdminController::class, 'formulario'])->name('admin.Formulario_empleados');
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
});

// Ruta adicional para compatibilidad
Route::get('/colaboradores/inicio', [ColaboradorController::class, 'principal'])->name('colaboradores.inicio');





// ================= INSTRUCTOR =================
// Route::prefix('inst')->group(function () {
//     Route::get('/principal', [InstructorController::class, 'principal'])->name('inst.principal');
//     Route::get('/horario', [InstructorController::class, 'horario'])->name('inst.horarios');
// });

// Rutas para instructores

Route::get('/instructores/create', [InstructorController::class, 'create'])->name('instructores.create');
Route::resource('instructores', InstructorController::class);
Route::get('/instructores/{id}/edit', [InstructorController::class, 'edit'])->name('instructores.edit');
Route::put('/instructores/{id}', [InstructorController::class, 'update'])->name('instructores.update');
Route::post('/colaboradores/instructores', [InstructorController::class, 'store'])->name('instructores.store');
Route::get('/colaboradores/instructores', [InstructorController::class, 'index'])->name('instructores.index');
Route::get('/colaborador/inicio', [InstructorController::class, 'principal'])->name('colaborador.inicio');

// ================= HORARIOS =================
Route::get('/gestion_clases/principal', [HorarioController::class, 'mostrarPrincipal'])->name('gestion_clases.principal');
Route::get('/colab/horarios/crear', [HorarioController::class, 'create'])->name('horarios.create');
Route::post('/colab/horarios', [HorarioController::class, 'store'])->name('horarios.store');
Route::get('/horarios/{horario}/edit', [HorarioController::class, 'edit'])->name('horarios.edit');
Route::put('/horarios/{horario}', [HorarioController::class, 'update'])->name('horarios.update');
Route::delete('/horarios/{horario}', [HorarioController::class, 'destroy'])->name('horarios.destroy');
Route::get('/horarios/{id}/edit', [HorarioController::class, 'edit'])->name('horarios.edit');
Route::put('/horarios/{id}', [HorarioController::class, 'update'])->name('horarios.update');




// ================= ESTUDIANTES =================
Route::get('/inscripcion_estudiante', [EstudianteController::class, 'index'])->name('estudiantes.index');

Route::get('/estudiantes/create', [EstudianteController::class, 'create'])->name('estudiantes.create');

Route::post('/inscripcion_estudiante', [EstudianteController::class, 'store'])->name('estudiantes.store');

Route::get('/inscripcion_estudiante/{estudiante:documento}/edit', [EstudianteController::class, 'edit'])->name('estudiante.edit');

Route::put('/inscripcion_estudiante/{estudiante:documento}', [EstudianteController::class, 'update'])->name('estudiantes.update');

Route::delete('/inscripcion_estudiante/{estudiante:documento}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');






// ================= REPORTES =================
Route::get('/reportes/inscripciones', [ReporteController::class, 'reporteInscripciones'])->name('reportes.inscripciones');




//rutas de instructores//----------------------------//

Route::prefix('inst')->group(function () {
    Route::get('/principal', [InstrucController::class, 'principal'])->name('inst.principal');
});

Route::prefix('inst')->group(function () {
    Route::get('/horario', [InstructorHorarioController::class, 'horario'])->name('inst.horarios');

    Route::get('/horario/actividades', [InstructorHorarioController::class, 'obtenerActividades'])->name('inst.horarios.actividades');

    Route::post('/horario/guardar', [InstructorHorarioController::class, 'guardarActividad'])->name('inst.horarios.guardar');

    Route::put('/horario/actualizar/{id}', [InstructorHorarioController::class, 'actualizarActividad'])->name('inst.horarios.actualizar');
    
    Route::delete('/horario/eliminar/{id}', [InstructorHorarioController::class, 'eliminarActividad'])->name('inst.horarios.eliminar');
});

Route::prefix('inst')->group(function () {
    Route::get('/asistencia', [AsistenciaController::class, 'seleccionarGrupo'])->name('inst.asistencia');

    Route::get('/asistencia/grupo/{nombre}', [AsistenciaController::class, 'tomarAsistenciaPorGrupo'])->name('asistencia.tomar.grupo');

    Route::get('/asistencia/{grupo_id}', [AsistenciaController::class, 'verSubgrupos'])->name('asistencia.subgrupos');

    Route::get('/asistencia/subgrupo/{id}', [AsistenciaController::class, 'tomarAsistenciaPorSubgrupo'])->name('asistencia.tomar.subgrupo');

    Route::post('/asistencia/guardar', [AsistenciaController::class, 'guardar'])->name('asistencia.guardar');
});

Route::prefix('inst')->group(function () {
    Route::get('/reporte', [AsistenciaController::class, 'reporteAsistencias'])->name('inst.reporte');
});
