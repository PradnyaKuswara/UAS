<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', 'App\Http\Controllers\UserController@store');
Route::post('/login', 'App\Http\Controllers\LoginController@store');


Route::get('/user', 'App\Http\Controllers\UserController@index');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@show');
Route::put('/user/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/user/{id}', 'App\Http\Controllers\UserController@destroy');

Route::apiResource('/pesawats', App\Http\Controllers\PesawatController::class);
Route::apiResource('/keretas', App\Http\Controllers\KeretaController::class);
Route::apiResource('/buses', App\Http\Controllers\BusController::class);