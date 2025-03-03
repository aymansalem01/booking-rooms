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
            // 'name' => 'required|string|max:255',
            // 'address' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required',
            // 'description' => 'required|string|max:255',
            'discount' => 'required|integer',
            // 'total_price' => 'required|integer',
            'count'=> 'required|integer',
            // 'size'=>'required|integer',
            'category_id'  => 'required|exists:categories,id',

        ]);
        $totalPrice = $request->price - $request->discount;
        $room->update([
            // 'name' => $request->name,
            // 'address' => $request->address,
            'price' => $request->price,
            'status' => $request->status,
            // 'description' => $request->description,
            // 'size' => $request->size,
            // 'capacity' => $request->capacity,
            // 'user_id' => $request->category_id,
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
        $rooms = Room::findOrFail($id);
        $rooms->delete();
        return redirect()->back()->with('success', 'Room deleted successfully!');
    }
}
