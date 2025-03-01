<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Subscribe;

class FeedbackController extends Controller
{
    public function feedback(Request $request)
    {
        $feedback = Feedback::create([
            'email' => $request->email,
            'comment' => $request->comment,

        ]);
        return response()->json([
            'message' => 'Feedback submitted successfully',
            'feedback' => $feedback,
    ]);

    }
    public function subscribe(Request $request)
    {
        $subscribe = Subscribe::create([
            'email' => $request->email,
        ]);
        return response()->json($subscribe);
    }

    public function comment(Request $request)
    {
        $review = Review::create([
            
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'comment' => $request->comment,
            'rate' => $request->rate,

        ]);
        return response()->json($review);

    }
}
