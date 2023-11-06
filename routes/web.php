<?php

use App\Http\Controllers\Api\FacebookController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FigureController;
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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('login', [AuthController::class,'getFormLogin'])->name('get_form_login');
Route::post('login', [AuthController::class,'login'])->name('login');

Route::get('register', [AuthController::class,'getFormRegister'])->name('get_form_register');
Route::post('register', [AuthController::class,'register'])->name('register');

Route::get('/api/google', [GoogleController::class, 'callApiGoogle'])->name("login_with_google");
Route::get('/api/google/callback', [GoogleController::class, 'loginGoogleCallback']);

Route::get('/api/facebook', [FacebookController::class, 'callApiFacebook'])->name("login_with_facebook");
Route::get('/api/facebook/callback', [FacebookController::class, 'loginFacebookCallback']);


Route::group(['middleware'=>'userLogin'],function (){
    Route::get('logout', [AuthController::class,'logout'])->name('logout'); 
    Route::get('/', [AuthController::class,'getHomePage']);
    Route::get('/homepage', [AuthController::class,'getHomePage'])->name('get_home_page');
    Route::get('/get-figure', [FigureController::class,'getAllFigure'])->name('get_list_figure');
});
