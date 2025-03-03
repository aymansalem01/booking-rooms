<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Review; 

class SearchController extends Controller
{
   public function search(Request $request)
{
    $query = $request->input('query');
    $role = $request->input('role'); 
    $status = $request->input('status'); 
    $category = $request->input('category');
    $min_price = $request->input('min_price');
    $max_price = $request->input('max_price');
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $page = $request->input('page');
    $sort_by_price = $request->input('sort_by_price');
    $min_rating = $request->input('min_rating'); 
    $sort_by_date = $request->input('sort_by_date');
    $sort_by_total_price = $request->input('sort_by_total_price');

    $categories = Category::all();

    if ($page === 'users') {
        $users = User::query();

        if ($query) {
            $users = $users->where('name', 'LIKE', "%$query%")
                ->orWhere('email', 'LIKE', "%$query%");
        }

        if ($role) {
            $users = $users->where('role', $role);
        }

        if ($status) {
            $users = $users->where('status', $status);
        }

        $users = $users->paginate(6)->appends($request->except('page'));
        return view('admin.user.user-mangment', compact('users'));
    }

    if ($page === 'rooms') {
        $rooms = Room::query();

        if ($query) {
            $rooms = $rooms->where('name', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%");
        }

        // if ($category) {
        //     $rooms = $rooms->where('category_id', $category);
        // }

        if ($status) {
            $rooms = $rooms->where('status', $status);
        }

      

        if ($sort_by_price) {
            $rooms = $rooms->orderBy('price', $sort_by_price);
        }

        $rooms = $rooms->paginate(6)->appends($request->except('page'));

        return view('admin.room.room-mangment', compact('rooms', 'categories'));
    }

    
    if ($page === 'reviews') {
        $reviews = Review::query();
    
        if ($query) {
            $reviews = $reviews->whereHas('user', function($userQuery) use ($query) {
                $userQuery->where('name', 'LIKE', "%$query%");
            });
        }
    
        if ($query) {
            $reviews = $reviews->orWhereHas('room', function($roomQuery) use ($query) {
                $roomQuery->where('name', 'LIKE', "%$query%");
            });
        }
    
        if ($min_rating) {
            $reviews = $reviews->where('rate', '>=', $min_rating);
        }
    
        if ($sort_by_rating = $request->input('sort_by_rating')) {
            if ($sort_by_rating == 'asc') {
                $reviews = $reviews->orderBy('rate', 'asc');
            } elseif ($sort_by_rating == 'desc') {
                $reviews = $reviews->orderBy('rate', 'desc');
            }
        }
    
        $reviews = $reviews->paginate(6)->appends($request->except('page'));
    
        return view('admin.review.reviews-mangment', compact('reviews'));
    }
    

    if ($page === 'categories') {
        $categoriesQuery = Category::query();

        if ($query) {
            $categoriesQuery = $categoriesQuery->where('name', 'LIKE', "%$query%");
        }

        $categories = $categoriesQuery->paginate(10)->appends($request->except('page'));
        return view('admin.category.category-mangment', compact('categories'));
    }

    if ($page === 'coupons') {
        $coupons = Coupon::query();
    
        if ($query) {
            $coupons = $coupons->where('name', 'LIKE', "%$query%");
        }
    
        if ($status) {
            $coupons = $coupons->where('status', $status);
        }
    
        if ($request->filled('min_discount')) {
            $coupons = $coupons->where('discount', '>=', $request->input('min_discount'));
        }
    
        if ($request->filled('max_discount')) {
            $coupons = $coupons->where('discount', '<=', $request->input('max_discount'));
        }
    
        if ($sort_by_discount = $request->input('sort_by_discount')) {
            if ($sort_by_discount == 'asc') {
                $coupons = $coupons->orderBy('discount', 'asc');
            } elseif ($sort_by_discount == 'desc') {
                $coupons = $coupons->orderBy('discount', 'desc');
            }
        }
    
        $coupons = $coupons->paginate(10)->appends($request->except('page'));
        return view('admin.coupon.discounts-mangment', compact('coupons'));
    }
    

    if ($page === 'booking') {
        $booking = Booking::query(); // Initialize the query
    
        if ($sort_by_date) {
            $booking->orderBy('start_date', $sort_by_date);
        }
    
        if ($sort_by_price) {
            $booking->orderBy('price', $sort_by_price);
        }
    
        if ($sort_by_total_price) {
            $booking->orderBy('total_price', $sort_by_total_price);
        }
    
        $booking = $booking->paginate(10)->appends($request->except('page'));
    
        return view('admin.booking.booking-mangment', compact('booking'));
    }
    
    
    
    return redirect()->back()->with('error', 'Invalid search request');
}
}
