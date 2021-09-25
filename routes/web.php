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

Route::get('/', 'App\Http\Controllers\EmpleadoController@index');
Route::get('/empleado', 'App\Http\Controllers\EmpleadoController@viewCreate');
Route::post('/empleado/create', 'App\Http\Controllers\EmpleadoController@create');
Route::get('/empleado/{id}', 'App\Http\Controllers\EmpleadoController@viewEdit');
Route::put('/empleado/{id}/edit', 'App\Http\Controllers\EmpleadoController@editEmp');
Route::delete('/empleado/{id}/delete', 'App\Http\Controllers\EmpleadoController@deletEmp');