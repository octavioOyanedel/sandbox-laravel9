<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/select2', [App\Http\Controllers\HomeController::class, 'select2'])->name('select2');
Route::get('/select2-livewire', [App\Http\Controllers\HomeController::class, 'select2Livewire'])->name('select2-livewire');
Route::get('/select2-livewire-componentes', [App\Http\Controllers\HomeController::class, 'select2LivewireCOmponentes'])->name('select2-livewire-componentes');
Route::get('/tom-select', [App\Http\Controllers\HomeController::class, 'tomSelect'])->name('tom-select');
Route::get('/select-normal', [App\Http\Controllers\HomeController::class, 'selectNormal'])->name('select-normal');

