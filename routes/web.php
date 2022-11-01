<?php

use App\Http\Controllers\UserController;
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

//Route::view('/user-form','user.Userform');
Route::get('/user-form',[UserController::class,'index'])->name('user-form');
Route::post('/create-user',[UserController::class,'storeUser'])->name('create-user');
