<?php

namespace App\Http\Controllers\admin;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;

class RoomController extends Controller
{
    public function index()
    {

        $users = User::all();
        $rooms = Room::whereHas('user', function ($query) {
            $query->where('role', 'owner');
        })->with('user')->get();

        return view('admin\room-mangment' , compact('rooms'));
    }

    public function show(string $id)

    {
        $rooms = Room::findOrFail($id);
        return view('admin.singleroom', compact('rooms'));
    }

    public function edit(string $id)
    {
        $rooms = Room::findOrFail($id);
        return view('admin.edit-room', compact('rooms'));
    }


    public function update(Request $request, string $id)
    {
        $rooms = Room::findOrFail($id);
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'address' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required|in:Default,av',
            'description' => 'required|string|max:255',
            'count' => 'required|integer',

        ]);
        $rooms->update($request->all()); 
               return redirect()->route('room.index')->with('updated');
    }

    public function destroy(string $id)
    {
        $rooms = Room::findOrFail($id);
        $rooms->delete();
        return redirect()->route('admin.room-mangment.indexRoom')->with('deleted');
    }
}
