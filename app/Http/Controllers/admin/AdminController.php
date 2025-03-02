<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.user.user-mangment', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create-user');
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'string|min:8',
            'role' => 'required',
            'phone_number' => 'required|regex:/^07[0-9]{8}$/',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
            $image_path = uniqid() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image_path);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone_number' => $request->phone_number,
            'status' => $request->status,
            'image' => $image_path
        ]);
        return $this->index()->with('user created');
    }

    public function show(string $id)

    {
        $user = User::findOrFail($id);
        return view('admin.user.show-user', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.user.edit-user', compact('user'));
    }


    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'role' => 'required',
            'phone_number' => 'required|regex:/^07[0-9]{8}$/',
            'status' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $image_path = uniqid() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image_path);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'phone_number' => $request->phone_number,
                'status' => $request->status,
                'image' => $image_path
            ]);
            return $this->index()->with(['message' => 'updated' ]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone_number' => $request->phone_number,
            'status' => $request->status,
        ]);
        return $this->index()->with(['message' => 'updated' ]);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->index()->with([ 'message' => 'deleted']);
    }
}
