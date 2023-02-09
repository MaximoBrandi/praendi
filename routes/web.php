<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

    Route::get('/post/{id}', 'post');

    Route::get('/profile', 'profile')->name('profile');

});
