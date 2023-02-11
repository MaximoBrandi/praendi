<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web3LoginController;

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

Route::controller(Controller::class)->group(function () {

    Route::get('', 'index')->name('index');

    Route::get('/category', 'category')->name('category');

    Route::get('/category/{id}', 'categorySearch');

    Route::post('/category', 'categoryPOST');

    Route::post('/category/{id}', 'categoryPOST');

    Route::get('/post/{id}', 'post');

    Route::get('/profile', 'profile')->name('profile');

    Route::get('/login', 'login')->name('login');

    Route::get('/register', 'register')->name('register');
});

Route::controller(Web3LoginController::class)->group(function () {

    Route::get('/web3-login-message', 'message');

    Route::post('/web3-login-verify', 'verify');

});

