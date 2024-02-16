<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;


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
        // If using Inertia, return an Inertia response instead
        return Inertia::render('Products/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            // Assume 'categories' is an array of category IDs
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id', // Validate each category ID exists
        ]);

        $product = Product::create($validatedData);
        $product->categories()->attach($request->input('categories'));

        // Redirect back to the products index with a success message
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

    public function destroy(Product $product) // Use singular for the variable
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
