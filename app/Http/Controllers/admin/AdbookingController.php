<?php

namespace App\Http\Controllers\admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdbookingController extends Controller
{
    public function index(Request $request)
    {

        $user = User::all();
        $room = Room::all();
        $booking = Booking::with('user', 'room');
        $booking = Booking::paginate(6);

        return view('admin/booking-mangment', compact('booking'));
    }

    public function show(string $id)

    {
        $booking = Booking::findOrFail($id);
        return view('admin.singbooking', compact('booking'));
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.booking-mangment.indexBooking')->with('deleted');
    }
}
