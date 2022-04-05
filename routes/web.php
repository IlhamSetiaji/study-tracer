<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;

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

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'storeLogin']);


Route::middleware('auth')->group(function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::middleware('is.admin')->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('/',[AdminController::class,'index']);
            Route::get('/register',[AuthController::class,'register'])->name('register');
            Route::post('/register',[AuthController::class,'storeRegister']);
            Route::get('/account',[AdminController::class,'showAllAccounts']);
            Route::post('/account/{userID}/update',[AuthController::class,'updateAccount']);
            Route::get('/account/{userID}/update-status',[AuthController::class,'updateAccountStatus']);
            Route::get('/account/{userID}/delete',[AuthController::class,'deleteAccount']);
        });
    });

    Route::middleware('is.guru')->group(function(){
        Route::prefix('guru')->group(function(){
            Route::get('/',[GuruController::class,'index']);
            Route::get('/study',[GuruController::class,'daftarStudy']);
            Route::post('/study',[GuruController::class,'storeStudy']);
            Route::post('/study/{studyID}/update',[GuruController::class,'updateStudy']);
            Route::get('/study/{studyID}/delete',[GuruController::class,'deleteStudy']);
        });
    });

    Route::middleware('is.siswa')->group(function(){
        Route::prefix('siswa')->group(function(){
            Route::get('/',[SiswaController::class,'index']);
        });
    });
});
