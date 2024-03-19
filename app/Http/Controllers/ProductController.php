<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories', 'images'])->get();
        $categories = Category::all();
        $images = Image::all();

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create');
    }

    public function store(Request $request)
    {
        Log::info('Store method called with request data:', $request->all());

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);

        Log::info('After validation');

        $product = Product::create($validatedData);
        $product->categories()->attach($request->input('categories'));


        if ($request->hasFile('images')) {
            Log::info('Has images');
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/products');
                $product->images()->create(['image' => $path]);
            }
        }
        Log::info('Store method completed');

        $product->load('categories', 'images');

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return Inertia::render('Admin/Products/Show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        Log::info('Update method called with request data:', $request->all());

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'removedImages.*' => 'exists:images,id',
        ]);

        Log::info('Update method validationd completed');

        // Update the product
        $product->update($validatedData);
        $product->categories()->sync($request->categories);

        if ($request->has('removedImages')) {
            foreach ($request->removedImages as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    Storage::delete($image->image);
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            // Optionally, remove existing images here if that's the intended behavior
            foreach ($request->file('images') as $image) {
                $image = $image->store('public/products');
                $product->images()->create(['image' => $image]);
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
