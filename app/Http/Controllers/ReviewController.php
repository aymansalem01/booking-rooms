<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

use User;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->get();  
        return view('admin.reviews-mangment', compact('reviews'));  
    }
    
    
    
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    
    }
    
}
