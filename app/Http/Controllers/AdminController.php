<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Category,Booking,Room,Review,Image,Coupon};
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    public function indexUser()
    {
        $user = User::all();
        return view('admin.user-mangment');
        
    }

    public function createUser()
    {
        return view('admin.user-mangment');
    }

    public function storeUser(Request $request)
    {
      $validatedData=  $request->validate([
            'name' =>'required|string|max:255',
            'email'=>'required|email|unique:user,email',
            'password'=>'string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'role'=>'required|in:DEFAULT,user',
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

    /**
     * Display the specified resource.
     */
    public function showUser(string $id)
    
    {
        $user = User::findOrFail($id);
        return view('admin.single', compact('user'));


    }

    public function editUser(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));

    }


    public function updateUser(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData=  $request->validate([
            'name' =>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'role'=>'required|in:DEFAULT,user',
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

    public function destroyUser(string $id)
    {
       $user = User::findOrFail($id);
       $user->delete();
       return redirect()->route('admin.user-mangment.userindex')->with('deleted');
    }

///////////////////////////////////////////Category:


public function indexCategory()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'page' => 'nullable|string',
            'color' => 'nullable|string',
            'text' => 'nullable|string',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'page' => 'nullable|string',
            'color' => 'nullable|string',
            'text' => 'nullable|string',
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

}
