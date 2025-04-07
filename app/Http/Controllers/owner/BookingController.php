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
        $user = Auth::user();

        $query = Booking::whereHas('room', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        });

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('start_date', 'LIKE', "%{$search}%")
                    ->orWhere('end_date', 'LIKE', "%{$search}%")
                    ->orWhere('total_price', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('room', function ($roomQuery) use ($search) {
                        $roomQuery->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        if ($request->has('user_name') && $request->user_name != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->user_name}%");
            });
        }

        if ($request->has('room_id') && $request->room_id != '') {
            $query->where('room_id', $request->room_id);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('start_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('end_date', '<=', $request->end_date);
        }

        if ($request->has('total_price') && $request->total_price != '') {
            $query->where('total_price', '>=', $request->total_price);
        }

        $booking = $query->paginate(6);
        $rooms = Room::where('user_id', 9)->get();

        return view('owner.booking-mangment', compact('booking', 'rooms'));
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
        return redirect()->back()->with('deleted');
    }
    public function filter(Request $request)
    {
        $query = Booking::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $bookings = $query->get();

        return view('owner.bookings', compact('bookings'));
    }
    public function cancelBooking($bookingId)
    {

        $booking = Booking::findOrFail($bookingId);


        if ($booking->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'You cannot cancel this booking.');
        }


        $startDate = $booking->start_date instanceof \Carbon\Carbon ? $booking->start_date : \Carbon\Carbon::parse($booking->start_date);

        if ($startDate->diffInDays(now()) <= 2) {
            return redirect()->back()->with('error', 'Booking cannot be cancelled as it is within 2 days.');
        }


        $booking->delete();

        return redirect()->route('bookingUser')->with('success', 'Booking successfully cancelled.');
    }
}
