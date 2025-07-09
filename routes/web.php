<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\UsuarioController; 


Route::get('/', function () {
    return view('welcome');
});




// rutas del crud de gestion usuario--------------------------------------------------------//
Route::get('/libros/crear',[UsuarioController::class, 'create'])->name('usuario.crear');
Route::resource('usuario', UsuarioController::class);
Route::get('usuario', [UsuarioController::class, 'index'])->name('usuario.index');
Route::get('usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('usuario', [UsuarioController::class, 'store'])->name('usuario.store');
Route::get('usuario/{usuario}', [UsuarioController::class, 'show'])->name('usuario.show');
Route::get('usuario/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('usuario/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('usuario/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
//--------------------------------------------------------------------------------------------------------------------//


// rutas de autenticacion-----------------------------------------------------------//

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('admin/dashboard', AdminController::class)
->middleware(['auth','role:admin']);
Route::resource('editor/dashboard', EditorController::class)
->middleware(['auth','role:editor']);


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
Route::prefix('admin')->group(function() {
    Route::get('/principal', [AdminController::class, 'principal'])->name('admin.principal');
});
Route::prefix('admin')->group(function() {
    Route::get('/gestion', [AdminController::class, 'gestion'])->name('admin.Gestion_usuarios');
});
Route::prefix('admin')->group(function() {
    Route::get('/formulario', [AdminController::class, 'formulario'])->name('admin.Formulario_empleados');
});
Route::prefix('admin')->group(function() {
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
});
//---------------------------------------------------------------------------------------------------------------------------//