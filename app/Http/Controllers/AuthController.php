<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone_number' => 'required|regex:/^07[0-9]{8}$/',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        

        $image_path = uniqid() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image_path);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role' => 'user',
            'image' => $image_path,
        ]);

        return redirect()->route('log');
    }

    public  function login(Request $request)
    {
        $request->validate([
            'email' => 'required | email ',
            'password' => 'required | min:8'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if (Hash::check($request->password, $user->password)) {
            Auth::login(user: $user);
            $user->createToken($user->email)->accessToken;
            if ($user->role = 'user') {
                return redirect()->route('contact');
            }
            if ($user->role = 'admin') {
                return redirect()->route('admin');
            }
            if ($user->role = 'owner') {
                return redirect()->route('owner');
            }
        } else {
            return redirect()->back()->with(['password' => 'wrong password']);
        }
    }

    public function logout()
    {
        $id = auth()->user()->id;
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return redirect()->route('log');
    }

    public function edit()
    {
        $id = auth()->user()->id;
        return redirect()->route('edit', $id);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ' min:3',
            'phone_number' => ' regex:/^((07)))[0-9]{8}/',
        ]);
        $user = User::find($id);
        if ($user->name != $request->name || $user->phone_number != $request->phone_number || $user->image != $request->image) {
            if ($user->image != $request->image) {
                $request->validate([$request->image => 'mimes:jpg,bmp,png']);
                $image_path = uniqid() . '-' . $request->name . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $image_path);
            } else {
                $image_path = $request->image;
            }
            $user->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'image' => $image_path
            ]);
            return redirect()->back()->with(['message' => 'update success']);
        }
        return redirect()->back()->with(['message' => ' no think to update ']);
    }
}
