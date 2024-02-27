<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        $categories = Category::all(); // Fetch all categories

        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories
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
            'categories.*' => 'exists:categories,id', // Validate each category ID exists
            'image' => 'nullable|image|max:2048', // 2MB Max
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/products');
            $validatedData['image_path'] = $path;
        }

        $product = Product::create($validatedData);
        $product->categories()->attach($request->input('categories'));

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product) // Use singular for the variable
    {
        // If using Inertia, return an Inertia response instead
        return Inertia::render('Products/Show', ['product' => $product]);
    }

    public function edit(Product $product) // Use singular for the variable
    {
        // If using Inertia, return an Inertia response instead
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
        ]);

        // Update the product
        $product->update($validatedData);

        // Sync the categories to the product (detach any not in the array and attach any new ones)
        $product->categories()->sync($request->categories);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        // Delete the image file from storage
        if ($product->image_path && Storage::exists($product->image_path)) {
            Storage::delete($product->image_path);
        }

        // Delete the product record
        $product->delete();

        // Return a response or redirect
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
