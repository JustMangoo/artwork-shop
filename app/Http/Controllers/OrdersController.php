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
        $searchTerm = $request->input('search', '');
        $statusFilter = $request->input('status', null);

        $query = Order::query();

        // Apply search filters if a search term is provided
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('full_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter by status if a status is provided
        if (!empty($statusFilter)) {
            $query->where('status', $statusFilter);
        }

        $orders = $query->get();

        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders,
            'searchTerm' => $searchTerm,
            'selectedStatus' => $statusFilter  // Pass the selected status back to the frontend
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

    public function show(Order $order)
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
            'status' => 'required|in:shipped,completed,paid'
        ]);

        $order->status = $validatedData['status'];
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Pasūtījums veiksmīgi atjaunināts.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pasūtījums veiksmīgi dzēsts.');
    }

    public function customerOrders(Request $request)
    {
        $userEmail = $request->user()->email;

        $orders = Order::where('email', $userEmail)->get();


        return Inertia::render('User/Orders', [
            'orders' => $orders,
        ]);
    }

}
