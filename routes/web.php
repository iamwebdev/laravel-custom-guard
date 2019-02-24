<?php

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

# Homepage
Route::get('/', function () {
    return view('welcome');
});
# Auth Routes
Auth::routes();
# User Home Page
Route::get('/home', 'HomeController@index')->name('home');

# Admin Login Form 
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm');
# Login as Admin
Route::post('/admin/login', 'Auth\AdminLoginController@login');
# Admin Home Page
Route::get('/admin', 'AdminController@index');
# CRUD Operation for Users
Route::resource('/users','UserController');