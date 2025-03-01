<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewOwnerController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(6);
        return view('owner\reviews-mangment', compact('reviews'));
    }




    public function show(string $id)

    {
        $review = Review::findOrFail($id);
        return view('owner.show-review', compact('review'));
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.index')->with('success', 'Review deleted successfully.');
    }
}
