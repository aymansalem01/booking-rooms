<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;

class DashboardOwnerController extends Controller
{

    public function index()
    {
        $ownerId = auth()->id(); 

    $ownerRoomsCount = Room::where('user_id', $ownerId)->count();
    $ownerBookings = Booking::whereHas('room', function ($query) use ($ownerId) {
        $query->where('user_id', $ownerId);
    })->get();
    $ownerBookingsCount = $ownerBookings->count();
    $ownerRevenue = $ownerBookings->sum('total_price');
    $ownerReviewsCount = Review::whereHas('room', function ($query) use ($ownerId) {
        $query->where('user_id', $ownerId);
    })->count();

    return view('owner.dashboard', compact(
        'ownerRoomsCount', 'ownerBookingsCount',
        'ownerRevenue', 'ownerReviewsCount', 'ownerBookings'
    ));
    }
}
