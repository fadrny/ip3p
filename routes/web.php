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

Route::get('/', "App\Http\Controllers\PagesController@index")->name('home');
Route::resource("/room", "App\Http\Controllers\RoomController");
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::resource("/user", "App\Http\Controllers\UserController");
Route::delete("/key/{key}", "App\Http\Controllers\KeyController@destroy")->name('deleteKey');
Route::post("/key", "App\Http\Controllers\KeyController@store")->name('storeKey');
Route::get("/key/create", "App\Http\Controllers\KeyController@create");


