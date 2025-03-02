<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                        ->with(['review' => function($query) {
                            $query->orderByDesc('rate');
                        }])
                        ->take(4)->get();  ;

            return view('user.index', compact('rooms'));
    }

    public function show(string $id)
    {
        $room = Room::with(['image', 'review', 'user', 'category'])
         ->where('id', $id)
         ->first();
        return view('user.room_details', compact('room'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function roomCategory(string $id)
    {
        $rooms = Room::with(['image', 'review', 'user', 'category'])
            ->where('category_id', $id)
            ->paginate(9);
        return view('user.category', compact('rooms'));
    }
}
