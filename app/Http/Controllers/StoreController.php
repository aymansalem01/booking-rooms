<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{

    public function index()
    {
        $rooms = Room::with(['image', 'review', 'user', 'category'])->get();
       return view('user.rooms', compact('rooms'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
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
        ->get();
        dd($rooms);
       return view('user.rooms', compact('rooms'));
    }
}
