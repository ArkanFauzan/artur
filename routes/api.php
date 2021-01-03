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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/register','Auth\RegisterController');
// Route::post('/login','Auth\LoginController');
// Route::post('/admin/create-umkm','Admin\AdminController@create');
// Route::get('/member/profile', 'Member\MemberController@get_data');
// Route::post('/member/edit-profile','Member\MemberController@edit_profile');

// Route::post('/member/product/{id}','Member\MemberController@edit_product');
// Route::post('/login-member','Auth\LoginMemberController');

// Route::post('/member/transaction','Member\MemberController@transaction');