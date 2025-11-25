@extends('layout')

@section('title', 'My Profile - Technorics')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Account</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Sidebar -->
        <div class="space-y-2">
            <a href="{{ route('profile.show') }}" class="block px-4 py-3 bg-emerald-50 text-emerald-600 rounded-lg font-semibold">
                Profile
            </a>
            <a href="{{ route('orders.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                My Orders
            </a>
            <a href="{{ route('wishlist.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                Wishlist
            </a>
            <a href="{{ route('profile.password') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                Change Password
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                    Logout
                </button>
            </form>
        </div>

        <!-- Profile Info -->
        <div class="md:col-span-2 bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Profile Information</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-semibold text-gray-700">Name</label>
                    <p class="text-lg text-gray-900">{{ auth()->user()->name }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-semibold text-gray-700">Email</label>
                    <p class="text-lg text-gray-900">{{ auth()->user()->email }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-semibold text-gray-700">Member Since</label>
                    <p class="text-lg text-gray-900">{{ auth()->user()->created_at->format('F Y') }}</p>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t">
                <a href="{{ route('profile.password') }}" class="text-emerald-600 font-semibold hover:underline">
                    Change Password
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
