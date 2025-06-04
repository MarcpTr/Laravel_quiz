<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view("categories.index", compact("categories"));
    }
    public function create()
    {
        if (Auth::user()->name == "admin") {
            return view("admin.categories.create");
        }
        return redirect("404");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category.name' => 'required|string|max:255',
            'category.image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $categoryData = $validated['category'];
        if ($request->hasFile('category.image')) {
            $path = $request->file('category.image')->store('categories', 'public');
        } else {
            $path = null;
        }
        $category = Category::create([
            'name' => $categoryData['name'],
            'imageRef' => $path,
        ]);
        return redirect()->route('categories.create');
    }
}
