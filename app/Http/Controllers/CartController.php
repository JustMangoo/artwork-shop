<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index()
    {
        Session::forget('message');
        Session::forget('success');
        Session::forget('warning');
        Session::forget('error');

        $cart = $this->getCart();
        $cartItems = $cart->cartItems()->with(['product', 'product.images'])->get();

        return response()->json(['cartItems' => $cartItems]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);



        $cart = $this->getCart();
        $cart->cartItems()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );

        return redirect()->back()->with('success', 'Prece veiksmīgi pievienota grozam.');
    }

    public function destroy($id)
    {
        $cart = $this->getCart();
        $cartItem = $cart->cartItems()->where('id', $id)->first();


        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Prece veiksmīgi izņemta no groza.');
        }

        return redirect()->back()->with('error', 'Prece nav atrasta.');
    }

    public function clear()
    {
        $cart = $this->getCart();
        $cart->cartItems()->delete();

        $uniqueKey = now()->timestamp;

        return redirect()->back()->with('success', 'Grozs ir veiksmīgi notīrīts.');
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
            return redirect()->back();
        }

        return redirect()->back()->with('error', 'Prece nav atrasta grozā.');
    }

    private function getCart()
    {
        return Cart::firstOrCreate(['user_id' => Auth::id() ?? null]);
    }

}
