<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\ProductController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('admin/dashboard', AdminController::class)
->middleware(['auth','role:admin']);

Route::resource('editor/dashboard', EditorController::class)
->middleware(['auth','role:editor']);












Route::get('/libros/crear',[ProductController::class, 'create'])->name('libros.crear');



Route::post('/products/store',[ProductController::class, 'store'])->name('products.store');

Route::post('/products/index',[ProductController::class, 'index'])->name('products.index');

Route::post('/products/update',[ProductController::class, 'update'])->name('products.update');

Route::resource('products', ProductController::class); 

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
