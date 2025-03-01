<?php

namespace App\Http\Controllers\owner;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryOwnerController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(9);
        return view('owner\category-mangment', compact('categories'));
    }

    // public function create()
    // {
    //     return view('admin.createcategory');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'page' => 'nullable|string',
    //         'color' => 'nullable|string',
    //         'text' => 'nullable|string',
    //     ]);

    //     Category::create($request->all());
    //     return redirect()->route('category.index')->with('success', 'Category created successfully.');
    // }

    
  

   
}
