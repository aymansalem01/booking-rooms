<?php

namespace App\Http\Controllers\owner;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;

class RoomOwnerController extends Controller
{public function index()
    {
        $rooms = Room::whereHas('user', function ($query) {
            $query->where('role', 'owner');
        })->with('user')->get();

        return view('owner.room-mangment', compact('rooms'));
    }

    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return view('owner.single-room', compact('room'));
    }

    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        return view('owner.edit-room', compact('room'));
    }

    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);

        $request->validate([
            'price' => 'required|integer',
            'status' => 'required|in:Default,av,notav',
            'description' => 'required|string|max:255',
            'count' => 'required|integer',
        ]);

        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }

    public function create()
    {
        return view('owner.create-room');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required|in:Default,av,notav',
            'description' => 'required|string|max:255',
            'count' => 'required|integer',
        ]);

        Room::create($request->all());
        return redirect()->route('room.index')->with('success', 'Room added successfully');
    }
}
