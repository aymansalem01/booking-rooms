<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\StoreController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;


Route::view('/login', 'login');
Route::view('/signup', 'login');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/signup',[AuthController::class,'signup'])->name('signup');
Route::get('/logout/{id}',[AuthController::class,'logout'])->name('logout');
Route::get('/editprofile/{id}',[AuthController::class,'edit']);
Route::put('/editprofile/{id}',[AuthController::class,'update']);
Route::view('/feedback','welcome');
Route::post('/feedback',[FeedbackController::class,'feedback'])->name('feedback');
Route::post('/subscribe',[FeedbackController::class,'subscribe'])->name('subscribe');


Route::resource('store',StoreController::class);
Route::resource('admin',AdminController::class);
Route::resource('owner',OwnerController::class);

Route::view('/about', 'user.about_us')->name('about');


Route::get('/', function () {

    return view('user.index');
    //return view('welcome');
});
Route::get('/admin', function () {

    return view('admin.dashboard');
    //return view('welcome');
});


Route::middleware(['auth,role:user'])->group(function () {
    //<!------------------------------------------------------------------------------------>

















    //<!------------------------------------------------------------------------------------>


});
Route::middleware(['auth,role:admin'])->group(function () {
     //<!------------------------------------------------------------------------------------>



















    //<!------------------------------------------------------------------------------------>


});
Route::middleware(['auth,role:owner'])->group(function () {
     //<!------------------------------------------------------------------------------------>


















    //<!------------------------------------------------------------------------------------>
});
