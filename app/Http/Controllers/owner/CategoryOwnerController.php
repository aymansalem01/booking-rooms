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

}
