@extends('layout')

@section('title', 'Track Order - Technorics')

@section('content')
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">Track Order</span>
        </div>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Track Your Order</h1>
        <p class="text-xl text-gray-600">Enter your order details below</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Order Number</label>
                <input type="text" name="order_number" placeholder="ORD-XXXXXXXXX" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <p class="text-sm text-gray-500 mt-1">You can find this in your order confirmation email</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" placeholder="your.email@example.com" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <p class="text-sm text-gray-500 mt-1">The email used when placing the order</p>
            </div>

            <button type="submit" class="w-full bg-emerald-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-emerald-700 transition">
                Track Order
            </button>
        </form>

        <div class="mt-8 pt-8 border-t text-center">
            <p class="text-gray-600 mb-4">Already have an account?</p>
            <a href="{{ route('orders.index') }}" class="text-emerald-600 font-semibold hover:underline">
                View all your orders →
            </a>
        </div>
    </div>
</div>
@endsection
