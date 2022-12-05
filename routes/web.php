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
    return view('/page/index',[
        "title" => "Home"
    ]);
});

Route::get('/register', function () {
    return view('/page/register',[
        "title" => "Registrasi"
    ]);
});

Route::get('/destinasi', function () {
    return view('/page/destinasi',[
        "title" => "Destinasi Wisata"
    ]);
});
Route::get('/kuliner', function () {
    return view('/page/kuliner',[
        "title" => "Kuliner"
    ]);
});
Route::get('/event', function () {
    return view('/page/event',[
        "title" => "Event"
    ]);
});
Route::get('/infowisata', function () {
    return view('/page/infowisata',[
        "title" => "Info Wisata"
    ]);
});
Route::get('/transportasi', function () {
    return view('/page/transportasi',[
        "title" => "Transportasi"
    ]);
});

Route::resource('/user', \App\Http\Controllers\UserController::class);
Route::resource('/login', \App\Http\Controllers\LoginController::class);
