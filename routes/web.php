<?php

use App\Http\Controllers\GaleryController;
use App\Http\Controllers\AuthController;
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
    return view('login');
});
Route::middleware('auth')->group(function(){
    Route::resource('galery',GaleryController::class);
});
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'postlogin'])->name('postlogin');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'postRegister'])->name('postRegister');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
