<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return Inertia::render('Products/Index', ['products' => $products]);
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
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validatedData);
        return redirect()->route('products.index');
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

    public function update(Request $request, Product $product) // Use singular for the variable
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validatedData);
        return redirect()->route('products.index');
    }

    public function destroy(Product $product) // Use singular for the variable
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
