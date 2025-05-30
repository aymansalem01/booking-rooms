<?php

use App\Http\Controllers\admin\AdbookingController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SearchController;

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\owner\BookingController;
use App\Http\Controllers\owner\CategoryOwnerController;
use App\Http\Controllers\owner\RoomOwnerController;
use App\Http\Controllers\owner\ReviewOwnerController;
use App\Http\Controllers\owner\DashboardOwnerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;


Route::view('/login', 'login')->name('log');
Route::view('/signup', 'signup')->name('sign');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [StoreController::class, 'homePage'])->name('home');

Route::post('/contact', [FeedbackController::class, 'feedback'])->name('contact');
Route::view('/about', 'user.about_us')->name('about');
Route::view('/contact', 'user.contact')->name('contact');

Route::middleware(['auth'])->group(function () {
    Route::view('/editprofile', 'user.editprofile')->name('edit');
    Route::put('/editprofile/{id}', [AuthController::class, 'update'])->name('update');
    Route::view('/block', 'block')->name('block');
});

Route::middleware(['auth' , 'role:user'])->group(function () {
    Route::resource('store', StoreController::class);
    Route::post('/subscribe', [FeedbackController::class, 'subscribe'])->name('subscribe');
    Route::get('/category/{id}', [StoreController::class, 'roomCategory'])->name('room.category');
    Route::post('/store/{id}', [FeedbackController::class, 'comment'])->name('review');
    Route::get('/get-booked-dates/{id}', [StoreController::class, 'getBookingdates']);
    Route::get('/bookingUser', [StoreController::class, 'ShowUserBoking'])->name('bookingUser');
    Route::post('/store-booking/{id}', [StoreController::class, 'storeBooking'])->name('book');
    Route::delete('/booking/cancel/{bookingId}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');

});

Route::middleware(['auth' , 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin');
        Route::resource('user', AdminController::class);
        Route::resource('adcategory', CategoryController::class);
        Route::resource('coupon', CouponController::class);
        Route::resource('adreview', ReviewController::class);
        Route::resource('adroom', RoomController::class);
        Route::resource('adbooking', AdbookingController::class);
        Route::get('search', [SearchController::class, 'search'])->name('admin.search');
    });
});
Route::middleware(['auth' , 'role:owner'])->group(function () {
    Route::prefix('owner')->group(function () {
        Route::get('/dashboard', [DashboardOwnerController::class, 'index'])->name('owner');
        Route::resource('review', ReviewOwnerController::class);
        Route::resource('room', RoomOwnerController::class);
        Route::resource('booking', BookingController::class);
        Route::get('addimage/{id}', [RoomOwnerController::class, 'addimage'])->name('addimage');
        Route::post('addimage/{id}', [RoomOwnerController::class, 'storeimage'])->name('storeimage');
    });
});
