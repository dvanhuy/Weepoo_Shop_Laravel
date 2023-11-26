<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\FacebookController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FigureController;
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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::group(["prefix"=> "login"], function () {
    Route::get('', [AuthController::class,'getFormLogin'])->name('get_form_login');
    Route::post('', [AuthController::class,'login'])->name('login');
});

Route::group(["prefix"=> "register"], function () {
    Route::get('', [AuthController::class,'getFormRegister'])->name('get_form_register');
    Route::post('', [AuthController::class,'register'])->name('register');
});

Route::group(["prefix"=> "forgot-password"], function () {
    Route::get('', [AuthController::class, 'getFormForgotpass'])->name("get_form_fgpassword");
    Route::post('', [AuthController::class, 'sendMailResetPass'])->name("fgpassword");
    Route::get("/password/reset", [AuthController::class,"getFormResetPassword"])->name("get_form_reset_pass");
    Route::put("/password/reset", [AuthController::class,"resetpassword"])->name("reset_password");
});

Route::group(["prefix"=> "api"], function () {
    Route::get('/google', [GoogleController::class, 'callApiGoogle'])->name("login_with_google");
    Route::get('/google/callback', [GoogleController::class, 'loginGoogleCallback']);
    Route::get('/facebook', [FacebookController::class, 'callApiFacebook'])->name("login_with_facebook");
    Route::get('/facebook/callback', [FacebookController::class, 'loginFacebookCallback']);
});

Route::group(["prefix"=> "figures"], function () {
    Route::get('', [FigureController::class, 'index'])->name("figures.index");
    Route::get('/{figureID}',[FigureController::class, 'showDetail'])->name('figures.showdetail');
});

Route::get('/', [AuthController::class,'getHomePage']);
Route::get('/homepage', [AuthController::class,'getHomePage'])->name('get_home_page');

Route::group(['middleware'=>'userLogin'],function (){
    Route::get('logout', [AuthController::class,'logout'])->name('logout');
    Route::group(['prefix'=> 'users'], function () {
        Route::get('edit', [UserController::class,'getFormEditProfile'])->name('users.get_form_editprofile');
        Route::get('sendmailverify', [UserController::class,'sendmailverify'])->name('users.sendmailverify');
        Route::get('verify', [UserController::class,'verify'])->name('users.verify');
        Route::post('edit/{userID}', [UserController::class,'updateProfile'])->name('users.update_profile');
        Route::get('change-password', [UserController::class,'getFormChangePassword'])->name('users.get_form_changepassword');
        Route::post('change-password/{userID}', [UserController::class,'changePassword'])->name('users.change_password');
    });
    Route::group(['prefix'=> 'cart'], function () {
        Route::get('', [CartController::class,'index'])->name('cart.index');
        Route::post('add', [CartController::class,'add'])->name('cart.add');
        Route::get('delete/{cart_id}', [CartController::class,'delete'])->name('cart.delete');
    });
    Route::group(['middleware'=>'isAdminRole'],function (){
        Route::group(['prefix'=> 'manage/figures'], function () {
            Route::get('', [AdminController::class,'getFiguresForm'])->name('manage.get_figures_form');
            Route::get('add', [FigureController::class,'getFormAddFigure'])->name('figures.get_form_add');
            Route::post('add', [FigureController::class,'addFigure'])->name('figures.add_figure');
            Route::get('update/{figureID}', [FigureController::class,'getFormUpdateFigure'])->name('figures.get_form_update');
            Route::post('update/{figureID}', [FigureController::class,'updateFigure'])->name('figures.update_figure');
            Route::get('delete/{figureID}', [FigureController::class,'deleteFigure'])->name('figures.delete_figure');
        });
        Route::group(['prefix'=> 'manage/users'], function () {
            Route::get('', [AdminController::class,'getUsersForm'])->name('manage.get_users_form');
            Route::get('update/{userID}', [AdminController::class,'getFormUpdateUser'])->name('manage.get_form_update_user');
            Route::post('update/{userID}', [AdminController::class,'updateUser'])->name('manage.update_user');
            Route::get('delete/{userID}', [AdminController::class,'deleteUser'])->name('manage.delete_user');
        });
    });
});



