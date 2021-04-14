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

Route::get('/login','CustomAuthController@showLogin')->name('login');
Route::get('/register','CustomAuthController@showRegister')->name('register');

Route::post('/login-custom','CustomAuthController@login')->name('login.custom');
Route::post('/register-custom','CustomAuthController@register')->name('register.custom');
Route::post('/logout-custom','CustomAuthController@logout')->name('register.custom');

Route::get('/dashboard','HomeController@index')->name('dashboard');
Route::resources([
    'car'=>'CarController',
    'transaction'=>'TransactionController',
]);

Route::get('/', function () {
    return view('welcome');
});
