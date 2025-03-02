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
        return redirect()->back()->with(['message'=>'thanks for message']);
    }
    public function subscribe(Request $request)
    {
        Subscribe::create([
            'email' => $request->email,
        ]);
        return redirect()->back()->with(['message' => 'thanks for subscribe ']);
    }

    public function comment(Request $request , string $id)
    {
        $review = Review::create([

            'user_id' => auth()->user()->id,
            'room_id' => $id,
            'comment' => $request->comment,
            'rate' => $request->rate,

        ]);
        return redirect()->back()->with(['message' => 'thanks for your comment']);
    }
}
