<?php

use App\Http\Controllers\AuthController;
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


Route::get('/', function () {
    return view('welcome');
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
