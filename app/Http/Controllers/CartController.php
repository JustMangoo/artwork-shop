<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        $cartItems = $cart->cartItems()->with(['product', 'product.images'])->get();

        Log::info('CART index method called');

        return response()->json(['cartItems' => $cartItems]);
    }

    public function store(Request $request)
    {
        Log::info('CART store method called');

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart();
        $cart->cartItems()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );

        return response()->json(['message' => 'Item added to cart successfully.']);
    }

    public function destroy($id)
    {
        $cart = $this->getCart();
        $cartItem = $cart->cartItems()->where('id', $id)->first();

        Log::info('CART destroy method called');

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Item removed from cart successfully.']);
        }

        return response()->json(['error' => 'Item not found in cart.'], 404);
    }

    public function clear()
    {
        $cart = $this->getCart();
        $cart->cartItems()->delete();

        return response()->json(['message' => 'Cart cleared successfully.']);
    }

    private function getCart()
    {
        return Cart::firstOrCreate(['user_id' => Auth::id() ?? null]);
    }

    public function update(Request $request, $id)
    {
        Log::info('CART update method called');

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart();
        $cartItem = $cart->cartItems()->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            return response()->json(['message' => 'Quantity updated successfully.']);
        }

        return response()->json(['error' => 'Item not found in cart.'], 404);
    }

}
