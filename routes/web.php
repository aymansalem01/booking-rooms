<?php

use App\Http\Controllers\admin\AdbookingController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\StoreController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;


Route::view('/login', 'login')->name('log');
Route::view('/signup', 'login')->name('sign');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//-------------------------------------------------------------------------------------------------
Route::get('/editprofile', [AuthController::class, 'edit']);
Route::put('/editprofile/{id}', [AuthController::class, 'update']);
//------------------------------------------------------------------------------------------------------------
Route::post('/subscribe', [FeedbackController::class, 'subscribe'])->name('subscribe');
Route::get('/category/{id}', [StoreController::class, 'roomCategory'])->name('room.category');
Route::resource('store', StoreController::class);
Route::post('/contact', [FeedbackController::class, 'feedback'])->name('contact');
Route::view('/about', 'user.about_us')->name('about');
Route::view('/blog_detals', 'user.blog')->name('blog_details');
Route::view('/blog', 'user.blog_details')->name('blog');
Route::view('/contact', 'user.contact')->name('contact');
Route::middleware(['auth,role:user'])->group(function () {
    //<!------------------------------------------------------------------------------------>

});
//--------------------------------------------------------------------------------------------
Route::resource('/dashboard', AdminController::class);
Route::prefix('admin')->group(function () {
    Route::resource('user', AdminController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('coupon', CouponController::class);
    Route::resource('review', ReviewController::class);
    Route::resource('room', RoomController::class);
    Route::resource('booking', AdbookingController::class);
});
Route::middleware(['auth,role:admin'])->group(function () {
    //<!------------------------------------------------------------------------------------>

});
Route::resource('owner', OwnerController::class);
Route::middleware(['auth,role:owner'])->group(function () {
    //<!------------------------------------------------------------------------------------>


});
