<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController; // Importamos el controlador

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

// Rutas de Recurso para el AlumnoController (index, create, store, show, edit, update, destroy)
Route::resource('alumnos', AlumnoController::class);
