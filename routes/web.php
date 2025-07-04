<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('admin/dashboard', AdminController::class)
->middleware(['auth','role:admin']);

Route::resource('editor/dashboard', EditorController::class)
->middleware(['auth','role:editor']);