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
    return redirect('clientes');
});


Route::resource('clientes', 'ClienteController');
Route::resource('veterinarios', 'VeterinarioController');
Route::resource('especialidades', 'EspecialidadeController');