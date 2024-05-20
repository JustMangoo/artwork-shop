<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        Log::info('PRODUCTS index method:', $request->all());

        $searchTerm = $request->input('search', '');
        $categoryId = $request->input('category'); // Receive category ID from the request

        $query = Product::with(['category', 'images']);

        // Apply search filter if a search term is provided
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Filter by category if a category ID is provided
        if (!empty($categoryId)) {
            $query->whereHas('category', function ($q) use ($categoryId) {
                $q->where('id', $categoryId);
            });
        }

        $products = $query->get();
        $categories = Category::all();

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'categories' => $categories,
            'searchTerm' => $searchTerm,
            'selectedCategory' => $categoryId, // Pass the selected category back to the frontend
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
            'category' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:1048',
        ]);

        Log::info('After validation');

        $productData = [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category'],
        ];

        $product = Product::create($productData);

        if ($request->hasFile('images')) {
            Log::info('Has images');
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/products');
                $product->images()->create(['image' => $path]);
            }
        }

        Log::info('Store method completed');

        $product->load('category', 'images');

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($productId)
    {
        $product = Product::with('category', 'images')->findOrFail($productId);
        return Inertia::render('ProductDetails', ['product' => $product]);
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
            'category' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'removedImages.*' => 'exists:images,id',
        ]);
        Log::info('After update validation');

        // Update the product with validated data except for 'category'
        $product->update($request->except(['category', 'images', 'removedImages']));

        // Update the category separately
        $product->category_id = $request->category;
        $product->save();

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
        $product->delete();

        Log::info('Delete method completed');

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        $cartItems = $request->input('cartItems', []);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $product = Product::find($item['product']['id']);
            if (!$product) {
                continue; // Skip if product not found
            }
            $totalPrice += $product->price * $item['quantity'];
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => ['name' => $product->title],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        if (empty($lineItems)) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        $order = new Order([
            'total_price' => $totalPrice,
            'session_id' => $session->id,
            'items' => $cartItems,
            'status' => 'pending',
        ]);
        $order->save();

        return response()->json(['url' => $session->url]);
    }
    public function success()
    {
        return Inertia::render('User/CheckoutSuccess');
    }

    public function cancel()
    {
        return Inertia::render('User/CheckoutCancel');
    }

}
