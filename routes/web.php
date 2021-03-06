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

// $password= bcrypt("Artur.041020");

Route::get('/',function(){return redirect('/home');});
Route::view('/home','home');
Route::view('/login','login');
Route::view('/register','register');
Route::view('/umkm','umkm');
Route::view('/product','product');
Route::get('/product/{id}','Member\MemberController@detail_product');

Route::prefix('api')->group(function(){
    Route::post('/register','Auth\RegisterController');
    Route::post('/login','Auth\LoginAdminController');

    Route::get('/umkm','Member\MemberController@all_umkm');
    Route::get('/product','Member\MemberController@all_product');
    
    Route::middleware('auth')->group(function(){
        Route::middleware('admin')->group(function(){
            Route::get('/admin/new-umkm','Admin\AdminController@index');
            Route::post('/admin/create-umkm','Admin\AdminController@create');
            Route::get('/admin/umkm','Admin\AdminController@all_umkm');
            Route::post('/admin/login-member','Auth\LoginMemberController');

            Route::get('/overview','Admin\AdminController@overview');
        });

        Route::middleware('member')->group(function(){
            Route::get('/member/profile', 'Member\MemberController@get_data');
            Route::get('/member/products', 'Member\MemberController@get_products');
            Route::post('/member/edit-profile-picture','Member\MemberController@edit_profile_picture');
            Route::post('/member/edit-profile','Member\MemberController@edit_profile');
            Route::post('/member/my-product/add','Member\MemberController@create_product');
            Route::get('/member/product/{id}','Member\MemberController@show_product');
            Route::post('/member/product/{id}','Member\MemberController@edit_product');
            Route::delete('/member/product/{id}','Member\MemberController@delete_product');
    
            Route::post('/member/transaction','Member\MemberController@transaction');
        });
    });
});

Route::get('/logout','Auth\LogoutController');

Route::middleware('role')->group(function(){
    Route::get('/member',function(){return redirect('/member/my-profile');});
    Route::view('/member/my-profile','member.my_profile');
    Route::view('/member/edit-profile','member.edit_profile');
    Route::view('/member/my-product','member.my_product');
    Route::view('/member/edit-product/{id}','member.edit_product');
    Route::view('/member/my-product/add','member.add_product');
    Route::view('/member/my-transaction/update','member.my_transaction_update');

    Route::view('/admin','admin.overview');
    Route::view('/admin/new-umkm','admin.new_umkm');
    Route::view('/admin/login-to-umkm','admin.login_to_umkm');
});