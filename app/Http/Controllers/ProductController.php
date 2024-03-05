<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories', 'images'])->get();
        $categories = Category::all();
        $images = Image::all();

        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);

        $product = Product::create($validatedData);
        $product->categories()->attach($request->input('categories'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/products');
            $product->images()->create(['image' => $path]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return Inertia::render('Products/Show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',

        ]);

        // Update the product
        $product->update($validatedData);
        $product->categories()->sync($request->categories);

        if ($request->hasFile('images')) {
            $product->images()->each(function($image) { Storage::delete($image->image); });
            $product->images()->delete();

            foreach ($request->file('images') as $image) {
                $path = $image->store('public/products');
                $product->images()->create(['image' => $path]);
            }
        }

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Fetch all associated images
        $images = $product->images;

        // Delete the image files from storage
        foreach ($images as $image) {
            if (Storage::exists($image->image)) {
                Storage::delete($image->image);
            }
        }

        $product->images()->delete();
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
