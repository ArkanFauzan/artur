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

$password= bcrypt("haloo");

Route::view('/','home');
Route::view('/home','home');
Route::view('/login','login');
Route::view('/register','register');
Route::view('/umkm','umkm');

Route::view('/member','layout.member')->middleware('admin');
Route::view('/admin','layout.admin')->middleware('admin');

Route::prefix('api')->group(function(){
    Route::post('/register','Auth\RegisterController');
    Route::post('/login','Auth\LoginController');
    Route::get('/logout','Auth\LogoutController');
});