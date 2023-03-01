<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    return Redirect::route('login');
});

// Route for users 
Route::resource('users', '\App\Http\Controllers\UserController');
Route::post('user/confirm-email', [App\Http\Controllers\UserController::class, 'verifyAccount'])->name('user.verifyCode');


//Login  
Route::get('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('login/authenticate', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
