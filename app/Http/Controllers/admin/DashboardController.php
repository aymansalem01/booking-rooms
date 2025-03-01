<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function index()
    {
        $roomsCount = Room::count();
        $bookingsCount = Booking::count();
        $usersCount = User::count();
        $revenue = Booking::sum('total_price');
        $reviewsCount = Review::count(); 
        $ownersCount = User::where('role', 'owner')->count(); 
        $bookings = Booking::All();
        return view('admin.dashboard', compact(
            'roomsCount', 'bookingsCount', 'usersCount',
            'revenue', 'reviewsCount', 'ownersCount','bookings'
        ));
    }
}
