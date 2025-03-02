<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    public function index()
    {
        $id = auth()->user()->id;
        $rooms = Room::with(['category', 'image', 'user'])->where('id', '=', $id)->get();
        return view('owner.index', ['rooms' => $rooms]);
    }


    public function create()
    {
        $categories = Category::get();
        return view('owner.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            $request->name => 'required',
            $request->address => 'required',
            $request->category => 'required | exist:categories',
            $request->price => 'required',
            $request->description => 'required',
            $request->size => 'required ',
            $request->capacity => 'required'
        ]);
        $room =Room::create([
            'name' => $request->name,
            'address' => $request->address,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'size' => $request->size,
            'capacity' => $request->capacity
        ]);
        Image::create([
            'room_id' => $room->id,
            'image' => $request->image
        ]);
        return redirect()->back()->with(['message' => 'added successfully']);
    }


    public function show(string $id)
    {
        $room = Room::with(['category', 'image', 'user'])->find($id);
        return view('owner.show', ['room' => $room]);
    }


    public function edit(string $id)
    {
        $room = Room::with(['category', 'image', 'user'])->find($id);
        $categories = Category::get();
        return view('owner.edit', ['room' => $room, 'categories' => $categories]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            $request->name => 'required',
            $request->address => 'required',
            $request->category => 'required | exist:categories',
            $request->price => 'required',
            $request->description => 'required',
            $request->size => 'required ',
            $request->capacity => 'required'
        ]);
        Room::update([
            'name' => $request->name,
            'address' => $request->address,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'size' => $request->size,
            'capacity' => $request->capacity
        ]);
        return $this->index()->with(['message' => 'update successfully']);
    }

    public function destroy(string $id)
    {
        Room::destroy($id);
        return $this->index()->with(['message' => 'delete successfully']);
    }
}
