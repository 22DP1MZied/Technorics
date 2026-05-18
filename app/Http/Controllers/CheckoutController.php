<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Mail\OrderConfirmationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(function($item) {
            $price = $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        $shipping = $subtotal >= 100 ? 0 : 9.99;
        $tax = $subtotal * 0.10;
        $total = $subtotal + $shipping + $tax;

        // Izveido Stripe Payment Intent
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = PaymentIntent::create([
            'amount' => round($total * 100), // Stripe izmanto centus
            'currency' => 'eur',
            'metadata' => ['user_id' => Auth::id()],
        ]);

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total', 'paymentIntent'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|string',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_zip' => 'required|string',
            'shipping_country' => 'required|string',
            'payment_intent_id' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Pārbauda vai maksājums veiksmīgs
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = PaymentIntent::retrieve($validated['payment_intent_id']);

        if ($paymentIntent->status !== 'succeeded') {
            return back()->with('error', 'Payment was not successful. Please try again.');
        }

        $subtotal = $cartItems->sum(function($item) {
            $price = $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        $shipping = $subtotal >= 100 ? 0 : 9.99;
        $tax = $subtotal * 0.10;
        $total = $subtotal + $shipping + $tax;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'status' => 'processing',
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'shipping_name' => $validated['shipping_name'],
                'shipping_email' => $validated['shipping_email'],
                'shipping_phone' => $validated['shipping_phone'],
                'shipping_address' => $validated['shipping_address'],
                'shipping_city' => $validated['shipping_city'],
                'shipping_state' => $validated['shipping_state'],
                'shipping_zip' => $validated['shipping_zip'],
                'shipping_country' => $validated['shipping_country'],
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'payment_intent_id' => $validated['payment_intent_id'],
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($cartItems as $item) {
                $price = $item->product->discount_price ?? $item->product->price;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $price,
                    'total' => $price * $item->quantity,
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            CartItem::where('user_id', Auth::id())->delete();

            Mail::to($order->shipping_email)->send(new OrderConfirmationEmail($order));

            DB::commit();

            return redirect()->route('checkout.confirmation', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        $order->load(['items.product']);
        return view('checkout.confirmation', compact('order'));
    }

    private function getCartItems()
    {
        return CartItem::where('user_id', Auth::id())->with('product.category')->get();
    }
}
