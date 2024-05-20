<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        $orders = Order::query()

            ->get();

        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return Inertia::render('Admin/Orders/Edit', [
            'order' => $order,
        ]);
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update([
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
