<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
class ReviewOwnerController extends Controller
{
    public function index()
    {

    //    $user = Auth::user();
        $user = Auth::loginUsingId(10);

        if ($user->role !== 'owner') {
            return redirect()->route('log')->with( 'You are not owner');
        }

        $reviews = Review::whereHas('room', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(6);
    return view('owner\reviews-mangment', compact('reviews'));
    }





    public function show(string $id)

    {
        $review = Review::findOrFail($id);
        return view('owner.show-review', compact('review'));
    }


    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.index')->with('success', 'Review deleted successfully.');
    }
}
