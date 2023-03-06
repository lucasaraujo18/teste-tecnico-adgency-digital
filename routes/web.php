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

//Users 
Route::resource('users', '\App\Http\Controllers\UserController');
Route::post('user/confirm-email', [App\Http\Controllers\UserController::class, 'verifyAccount'])->name('user.verifyCode');

//Servers 
Route::resource('servers', '\App\Http\Controllers\ServerController');
Route::get('/servers/{server_id}/sites', [App\Http\Controllers\ServerController::class, 'deployListSite'])->name('severs-sites');

//Sites 
Route::resource('sites', '\App\Http\Controllers\SiteController');
Route::get('sites/index/{id}', [App\Http\Controllers\SiteController::class, 'indexByServer'])->name('indexByServer');
Route::get('sites/create/{id}', [App\Http\Controllers\SiteController::class, 'createByServer'])->name('createByServer');

//Login  
Route::get('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('login/authenticate', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// Home 
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//GitHub
Route::get('github', [App\Http\Controllers\GitHubController::class, 'index'])->name('github.index');
Route::get('auth/github', [App\Http\Controllers\GitHubController::class, 'gitRedirect']);
Route::get('auth/github/callback', [App\Http\Controllers\GitHubController::class, 'gitCallback']);
Route::get('github/gitRepos', [App\Http\Controllers\GitHubController::class, 'gitUserRepo'])->name('gitUserRepo');
