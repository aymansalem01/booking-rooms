<?php

namespace App\Http\Controllers\admin;

use App\Models\Room;
use App\Models\Category;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $categories = Category::all();


        $rooms = Room::with(['user', 'category', 'image'])
        ->paginate(6);
        return view('admin.room.room-mangment' , compact('rooms'));
    }

    public function show(string $id)

    {
        $rooms = Room::findOrFail($id);
        return view('admin.room.singleroom', compact('rooms'));
    }

    public function edit(string $id)
    {
        $categories = Category::get();
        $room = Room::findOrFail($id);
        return view('admin.room.edit-room', compact('room','categories'));
    }

    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);

        $request->validate([
            'price' => 'required|integer',
            'status' => 'required',
            'discount' => 'required|integer|min:0|max:100',
            'count'=> 'integer',
            'category_id'  => 'required|exists:categories,id',

        ]);
        $totalPrice = $request->price - $request->discount;
        $room->update([
            'price' => $request->price,
            'status' => $request->status,
            'discount'=>$request->discount,
            'count'=>$request->count,
            'total_price' => $totalPrice,
            'category_id' => $request->category_id,

        ]);


        return $this->index()->with('message', 'Room updated successfully');
    }

    public function destroy(string $id)
    {
        $rooms = Room::findOrFail($id);
        $rooms->delete();
        return redirect()->back()->with('message', 'Room deleted successfully!');
    }
}
