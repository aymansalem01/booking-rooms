<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review; 

class ReviewController extends Controller {
    public function index()
     {
        $reviews = Review::paginate(8);
        return view('admin\reviews-mangment', compact('reviews'));
    }


    
    
    
    public function destroy($id) {
        $review = Review::findOrFail($id);
        $review->delete();
        
        return redirect()->route('review.index')->with('success', 'Review deleted successfully.');
    }
    
}
