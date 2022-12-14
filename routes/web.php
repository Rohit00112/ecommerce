<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CarasoulController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExtrafieldsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('/carasoul', CarasoulController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/brand', BrandsController::class);
    Route::resource('/extrafields', ExtrafieldsController::class);
    Route::resource('/products', ProductController::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
