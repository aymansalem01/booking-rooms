<?php

namespace App\Http\Controllers\owner;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class RoomOwnerController extends Controller
{public function index()
    {
        $user = Auth::loginUsingId(10);

        $rooms = Room::whereHas('user', function ($query) {
            $query->where('role', 'owner');
        })->with('user')->paginate(7);

        return view('owner.room-mangment', compact('rooms'));
    }

    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return view('owner.single-room', compact('room'));
    }

    public function edit(string $id)
    {
        $categories = Category::get();
        $room = Room::findOrFail($id);
        return view('owner.edit-room', compact('room','categories'));
    }

    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required',
            'description' => 'required|string|max:255',
            'discount' => 'required|integer',
            // 'total_price' => 'required|integer',
            'count'=> 'required|integer',
            'size'=>'required|integer',
            'category_id'  => 'required|exists:categories,id',

        ]);
        $totalPrice = $request->price - $request->discount;
        $room->update([
            'name' => $request->name,
            'address' => $request->address,
            'price' => $request->price,
            'status' => $request->status,
            'description' => $request->description,
            'size' => $request->size,
            'capacity' => $request->capacity,
            'user_id' => auth()->user()->id,
            'discount'=>$request->discount,
            'count'=>$request->count,
            'total_price' => $totalPrice,
            'category_id' => $request->category_id,

        ]);


        // $room->update($request->all());
        return $this->index()->with('success', 'Room updated successfully');
    }

    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return $this->index()->with('success', 'Room deleted successfully');
    }

    public function create()
    {
        $categories = Category::get();
        return view('owner.create-room' ,['categories' => $categories] );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required',
            'description' => 'required|string|max:255',
            'discount' => 'required|integer',
            // 'total_price' => 'required|integer',
            'count'=> 'required|integer',
            'size'=>'required|integer',
            'category_id'  => 'required|exists:categories,id',

        ]);
        $totalPrice = $request->price - $request->discount;

        Room::create([
            'name' => $request->name,
            'address' => $request->address,
            'price' => $request->price,
            'status' => $request->status,
            'description' => $request->description,
            'size' => $request->size,
            'capacity' => $request->capacity,
            'user_id' => auth()->user()->id,
            'discount'=>$request->discount,
            'count'=>$request->count,
            'total_price' => $totalPrice,
            'category_id' => $request->category_id,

        ]);
        return $this->index()->with('success', 'Room added successfully');
    }
}
