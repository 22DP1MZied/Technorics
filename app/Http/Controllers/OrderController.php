<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Use paginate() instead of get() to enable pagination
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Make sure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Load items and product relationships
        $order->load(['items.product']);

        return view('orders.show', compact('order'));
    }

    public function trackOrder()
    {
        return view('orders.track');
    }

    public function trackOrderSearch(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'email' => 'required|email',
        ]);

        $order = Order::where('order_number', $request->order_number)
            ->where('shipping_email', $request->email)
            ->with(['items.product'])
            ->first();

        if (!$order) {
            return back()->with('error', 'Order not found. Please check your order number and email.');
        }

        return view('orders.tracking', compact('order'));
    }
}
