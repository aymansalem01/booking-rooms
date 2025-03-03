<?php

namespace App\Http\Controllers\owner;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class RoomOwnerController extends Controller
{
    // public function index()
    // {

    //     $rooms = Room::with(['user', 'category', 'image'])->where('user_id', '=', 9)
    //         ->paginate(7);

    //     return view('owner.room-mangment', compact('rooms'));
    // }
    public function index(Request $request)
    {
        $query = Room::where('user_id', 1);


        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($catQuery) use ($search) {
                        $catQuery->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        if ($request->has('room_name') && $request->room_name != '') {
            $query->where('name', 'LIKE', "%{$request->room_name}%");
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        $rooms = $query->paginate(10);
        $categories = Category::all();

        return view('owner.room-mangment', compact('rooms', 'categories'));
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
        return view('owner.edit-room', compact('room', 'categories'));
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
            'count' => 'required|integer',
            'size' => 'required|integer',
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
            'discount' => $request->discount,
            'count' => $request->count,
            'total_price' => $totalPrice,
            'category_id' => $request->category_id,

        ]);


        // $room->update($request->all());
        return $this->index($request)->with('success', 'Room updated successfully');
    }

    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->back()->with('success', 'Room deleted successfully');
    }

    public function create()
    {
        $categories = Category::get();
        return view('owner.create-room', ['categories' => $categories]);
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
            'count' => 'required|integer',
            'size' => 'required|integer',
            'category_id'  => 'required|exists:categories,id',
            'image' =>  'required|mimes:jpg,jpeg,png|max:2048'

        ]);
        $totalPrice = $request->price - $request->discount;

        $image_path = uniqid() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image_path);

        $room = Room::create([
            'name' => $request->name,
            'address' => $request->address,
            'price' => $request->price,
            'status' => $request->status,
            'description' => $request->description,
            'size' => $request->size,
            'capacity' => $request->capacity,
            'user_id' => auth()->user()->id,
            'discount' => $request->discount,
            'count' => $request->count,
            'total_price' => $totalPrice,
            'category_id' => $request->category_id,
        ]);
        Image::create([
            'image' => $image_path,
            'room_id' => $room->id
        ]);
        return $this->index($request)->with('success', 'Room added successfully');
    }
    public function addimage(string $id)
    {
        $room = Room::find($id);
        return   view('owner.addimage', ['room' => $room]);
    }
    public function storeimage(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        $image_path = uniqid() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image_path);
        Image::create([
            'room_id' => $id,
            'image' => $image_path
        ]);
        return $this->index($request)->with('success', 'added image successfully');
    }
}
