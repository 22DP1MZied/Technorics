<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // FIX: Use paginate() instead of get() to enable pagination
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
}
