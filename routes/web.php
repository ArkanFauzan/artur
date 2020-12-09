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

Route::prefix('api')->group(function(){
    Route::post('/register','Auth\RegisterController');
    Route::post('/login','Auth\LoginController');

    Route::get('/admin/new-umkm','Admin\AdminController@index');
    Route::post('/admin/create-umkm','Admin\AdminController@create');

    Route::get('/member/profile', 'Member\MemberController@get_data');
    Route::post('/member/edit-profile','Member\MemberController@edit_profile');
});

Route::get('/logout','Auth\LogoutController');

Route::middleware('admin')->group(function(){
    Route::view('/member','member.my_profile');
    Route::view('/member/edit-profile','member.edit_profile');
    Route::view('/admin','admin.new_umkm');
});