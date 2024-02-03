<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = DB::table('categories')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    public function show()
    {
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|max:2048'
        ]);

        $data = $request->all();

        if ($image = $request->_image) {
            $data['image'] = $image->store('category', 'public');
        }

        Category::create($data);
        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|max:2048'
        ]);

        $data = $request->all();

        if ($image = $request->_image) {
            if (!is_null($category->image)) {
                if (Storage::disk('public')->fileExists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
            }
            $data['image'] = $image->store('category', 'public');
        }

        $category->update($data);
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        if (!is_null($category->image)) {
            if (Storage::disk('public')->fileExists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
        }

        $category->delete();
        return redirect()->route('category.index');
    }
}
