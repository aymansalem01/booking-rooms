<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $user = User::all();
        return view('admin.user-mangment');
    }

    public function create()
    {
        return view('admin.user-mangment');
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'role' => 'required|in:DEFAULT,user',
            'phone_number' => 'required|regex:/^((07)))[0-9]{8}/',
            'status' => 'required|in:Default,av',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $validatedData['image'] = $imagePath;
        }


        User::create($validatedData);
        return redirect()->route('admin.indexuser')->with('user created');
    }

    public function show(string $id)

    {
        $user = User::findOrFail($id);
        return view('admin.single', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'role' => 'required|in:DEFAULT,user',
            'phone_number' => 'required|regex:/^((07)))[0-9]{8}/',
            'status' => 'required|in:Default,va',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $validatedData['image'] = $imagePath;
        }

        $user->update($validatedData);
        return redirect()->route('admin.user-mangment.indexuser')->with('updated');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user-mangment.userindex')->with('deleted');
    }

}
