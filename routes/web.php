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

// Route for users 
Route::resource('users', '\App\Http\Controllers\UserController');
Route::post('user/confirm-email', [App\Http\Controllers\UserController::class, 'verifyAccount'])->name('user.verifyCode');
