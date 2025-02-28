<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
    {

        $user = User::all();
        $room = Room::whereHas('user', function ($query) {
            $query->where('role', 'owner');
        })->with('user')->get();

        return view('admin.room-mangment');
    }

    public function show(string $id)

    {
        $room = Room::findOrFail($id);
        return view('admin.singleroom', compact('room'));
    }

    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        return view('admin.edit', compact('room'));
    }


    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);
        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required|in:Default,va',
            'description' => 'required|text|max:255',
            'count' => 'required|integer|',

        ]);
        $room->update($validatedData);
        return redirect()->route('admin.room-mangment.indexRoom')->with('updated');
    }

    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('admin.room-mangment.indexRoom')->with('deleted');
    }
}
