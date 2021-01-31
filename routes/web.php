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

Auth::routes();

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('Index');
Route::get('/getcountry', [App\Http\Controllers\UserController::class, 'getCountry'])->name('GetCountry');
Route::post('/storeuser', [App\Http\Controllers\UserController::class, 'storeUser'])->name('StoreUser');
Route::get('/getuser', [App\Http\Controllers\UserController::class, 'getUser'])->name('GetUser');
