<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;

class StoreController extends Controller
{

    public function index()
    {
        $rooms = Room::with(['image', 'review', 'user', 'category'])->paginate(9);
        return view('user.rooms', compact('rooms'));
    }

    public function homePage()
    {
        $rooms = Room::with(['image', 'review', 'user', 'category'])
            ->with(['review' => function ($query) {
                $query->orderByDesc('rate');
            }])
            ->take(4)->get();
        return view('user.index', compact('rooms'));
    }

    public function show(string $id)
    {
        $room = Room::with(['image', 'review', 'user', 'category'])
            ->where('id', $id)
            ->first();
        return view('user.room_details', compact('room'));
    }

    public function roomCategory(string $id)
    {
        $rooms = Room::with(['image', 'review', 'user', 'category'])
            ->where('category_id', $id)
            ->paginate(9);
        return view('user.category', compact('rooms'));
    }

    public function getBookingdates(string $id)
    {
        $bookings = Booking::where('room_id', $id)->get();

        $bookedDates = [];
        foreach ($bookings as $booking) {
            $period = new DatePeriod(
                new DateTime($booking->start_date),
                new DateInterval('P1D'),
                (new DateTime($booking->end_date))->modify('+1 day')
            );

            foreach ($period as $date) {
                $bookedDates[] = $date->format('Y-m-d');
            }
        }

        return response()->json($bookedDates);
    }

    public function storeBooking(Request $request, string $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $existingBooking = Booking::where('room_id', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->exists();
        $room = Room::find($id);
        $startDate = new DateTime($request->start_date);
        $endDate = new DateTime($request->end_date);
        $interval = $startDate->diff($endDate);
        $days = $interval->days;
        $discount = Coupon::find(4);

        $price = $room->price * $days;
        $total_price = ($price - (($discount->discount/100)*$price));

        if ($existingBooking) {
            return redirect()->back()->with(['booking' => 'you can not select any day between day selected' ]);
        }

        Booking::create([
            'user_id' => 1,
            'room_id' => $id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price' => $price,
            'coupon_id' => 4,
            'total_price' => $total_price,
        ]);

        return redirect()->back()->with(['message' => 'booking successfully']);
    }
}
