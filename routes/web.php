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



Route::get('/', function () {

    return view('user.index');
});

Route::view('/admin', 'admin.dashboard')->name('admin');
Route::view('/user-mangment', 'admin.user-mangment')->name('user-mangment');
Route::view('/room-mangment', 'admin.room-mangment')->name('room-mangment');
Route::view('/owner-mangment', 'admin.owner-mangment')->name('owner-mangment');
Route::view('/discounts-mangment', 'admin.discounts-mangment')->name('discounts-mangment');
Route::view('/category-mangment', 'admin.category-mangment')->name('category-mangment');
Route::view('/booking-mangment', 'admin.booking-mangment')->name('booking-mangment');
Route::view('/review-mangment', 'admin.reviews-mangment')->name('reviews-mangment');

Route::view('/about', 'user.about_us')->name('about');
Route::view('/blog_detals', 'user.blog')->name('blog_details');
Route::view('/blog', 'user.blog_details')->name('blog');
Route::view('/contact', 'user.contact')->name('contact');
Route::view('/room_details', 'user.room_details')->name('room_details');
Route::view('/rooms', 'user.rooms')->name('rooms');









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
