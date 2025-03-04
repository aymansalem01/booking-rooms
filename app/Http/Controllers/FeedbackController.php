<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function feedback(Request $request)
    {
        $feedback = Feedback::create([
            'email' => $request->email,
            'comment' => $request->comment,
        ]);
        return redirect()->back()->with(['message' => 'thanks for message']);
    }
    public function subscribe(Request $request)
    {
        Subscribe::create([
            'email' => $request->email,
        ]);
        return redirect()->back()->with(['message' => 'thanks for subscribe ']);
    }

    public function comment(Request $request, string $id)
    {
        $hasBooking = Booking::where('user_id', auth()->user()->id)
            ->where('room_id', $id)
            ->exists();

        if (!$hasBooking) {
            return redirect()->back()->withErrors(['message' => 'You must book this room before leaving a review.']);
        }
        $review = Review::create([
            'user_id' => auth()->user()->id,
            'room_id' => $id,
            'comment' => $request->comment,
            'rate' => $request->rate,
        ]);
        return redirect()->back()->with(['message' => 'thanks for your comment']);
    }
}
