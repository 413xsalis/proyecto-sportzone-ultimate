<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\InstructorController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('admin/dashboard', AdminController::class)
->middleware(['auth','role:admin']);

Route::resource('colaborador/dashboard', ColaboradorController::class)
->middleware(['auth','role:colaborador']);

Route::resource('instructor/dashboard', InstructorController::class)
->middleware(['auth','role:instructor']);