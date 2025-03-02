<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(6);
        return view('admin.review.reviews-mangment', compact('reviews'));
    }




    public function show(string $id)

    {
        $review = Review::findOrFail($id);
        return view('admin.show-review', compact('review'));
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return $this->index()->with('success', 'Review deleted successfully.');
    }
}
