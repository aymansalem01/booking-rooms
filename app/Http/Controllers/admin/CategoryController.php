<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(9);
        return view('admin.category.category-mangment', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.createcategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'page' => 'nullable|string',
            'color' => 'nullable|string',
            'text' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'page' => $request->page,
            'color' => $request->color,
            'text' => $request->text
        ]);
        return $this->index()->with('success', 'Category created successfully.');
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.editcategory', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'page' => 'nullable|string',
            'color' => 'nullable|string',
            'text' => 'nullable|string',
        ]);

        Category::find($id)->update([
            'name' => $request->name,
            'page' => $request->page,
            'color' => $request->color,
            'text' => $request->text

        ]);
        return $this->index()->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->route('adcategory.index')->with('success', 'Category deleted successfully!');
    }
}
