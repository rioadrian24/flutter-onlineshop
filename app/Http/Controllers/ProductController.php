<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->input('search'), function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
            ->with('category')
            ->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    public function show()
    {
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required',
            '_image' => 'required|image|max:2048',
            'is_available' => 'required'
        ]);

        $data = $request->all();
        $data['category_id'] = $request->category;

        if ($image = $request->_image) {
            $data['image'] = $image->store('product', 'public');
        }

        Product::create($data);
        return redirect()->route('product.index');
    }

    public function edit(Product $product)
    {
        $categories = \App\Models\Category::all();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required',
            '_image' => $request->_image ? 'image|max:2048' : '',
            'is_available' => 'required'
        ]);

        $data = $request->all();
        $data['category_id'] = $request->category;

        if ($image = $request->_image) {
            if (!is_null($product->image)) {
                if (Storage::disk('public')->fileExists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
            }
            $data['image'] = $image->store('product', 'public');
        }

        $product->update($data);
        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        if (!is_null($product->image)) {
            if (Storage::disk('public')->fileExists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        }

        $product->delete();
        return redirect()->route('product.index');
    }
}
