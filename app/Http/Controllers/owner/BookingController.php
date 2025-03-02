<?php

namespace App\Http\Controllers\owner;

use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function index(Request $request)
    {
  //    $user = Auth::user();
        $user = Auth::loginUsingId(1);
        // $user = User::all();
        $room = Room::all();
        $booking = Booking::whereHas('room', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(6);
        return view('owner/booking-mangment', compact('booking'));
    }

    public function show(string $id)

    {
        $booking = Booking::findOrFail($id);
        return view('owner.show-booking', compact('booking'));
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('booking-mangment.index')->with('deleted');
    }
}
