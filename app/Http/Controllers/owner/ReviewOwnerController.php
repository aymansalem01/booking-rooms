<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
class ReviewOwnerController extends Controller
{
    // public function index()
    // {
    // //    $user = Auth::user();
    //     $user = Auth::loginUsingId(10);
    //     $reviews = Review::whereHas('room', function ($query) use ($user) {
    //         $query->where('user_id', 9);
    //     })->paginate(6);
    // return view('owner\reviews-mangment', compact('reviews'));
    // }

    public function index(Request $request)
    {
        $query = Review::whereHas('room', function ($q) {
            $q->where('user_id', 10); 
        });
    
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('comment', 'LIKE', "%{$search}%")
                  ->orWhere('rate', 'LIKE', "%{$search}%")
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
    
        if ($request->has('rate') && $request->rate != '') {
            $query->where('rate', $request->rate);
        }
    
        $reviews = $query->paginate(10);
        $rooms = Room::where('user_id', auth()->id())->get(); 
    
        return view('owner.reviews-mangment', compact('reviews', 'rooms'));
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

        return redirect()->back()->with('success', 'Review deleted successfully.');
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
}
