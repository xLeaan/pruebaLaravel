<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\EntidadeController;
use App\Http\Controllers\EntidadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('entidades', EntidadController::class);
Route::delete('/entidades/{id}', [EntidadController::class, 'destroy']);


Route::resource('contactos', ContactoController::class);
Route::delete('/contactos/{id}', [ContactoController::class, 'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

