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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/usersData/{data}', 'UserController@elements');
Route::POST('/users/{data}/credit', 'UserController@edit');
Route::get('/usersInjectData/{data}', 'UserController@elementsinject');
Route::get('/usersAdvData/{data}', 'UserController@elementsadvanced');
Route::get('/walletData/{data}', 'WalletController@elements');
Route::post('/usersUpdate', 'UserController@update');
Route::get('/wallet', 'WalletController@index')->name('wallet');
Route::get('/role', 'RoleController@index')->name('role');