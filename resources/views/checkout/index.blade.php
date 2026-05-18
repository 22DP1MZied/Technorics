@extends('layout')

@section('title', __('messages.checkout') . ' - Technorics')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.home') }}</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('cart.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-emerald-600">{{ __('messages.cart') }}</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white font-semibold">{{ __('messages.checkout') }}</span>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">{{ __('messages.checkout') }}</h1>

        @if($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
            <ul class="list-disc list-inside text-red-800 dark:text-red-200">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <p class="text-red-800">{{ session('error') }}</p>
        </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
            @csrf
            <input type="hidden" name="payment_intent_id" id="payment_intent_id" value="{{ $paymentIntent->id }}">

            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">

                    <!-- Piegādes informācija -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.shipping_information') }}</h2>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.full_name') }} *</label>
                                <input type="text" name="shipping_name" value="{{ old('shipping_name', Auth::user()->name) }}" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.email') }} *</label>
                                <input type="email" name="shipping_email" value="{{ old('shipping_email', Auth::user()->email) }}" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.phone') }} *</label>
                                <input type="tel" name="shipping_phone" value="{{ old('shipping_phone') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.country') }} *</label>
                                <select name="shipping_country" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                                    <option value="Latvia" selected>Latvia</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.address') }} *</label>
                                <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.city') }} *</label>
                                <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.state_province') }} *</label>
                                <input type="text" name="shipping_state" value="{{ old('shipping_state') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.zip_postal_code') }} *</label>
                                <input type="text" name="shipping_zip" value="{{ old('shipping_zip') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Maksājuma forma -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.payment_method') }}</h2>
                        </div>

                        <div id="payment-element" class="p-4 border border-gray-300 dark:border-gray-600 rounded-lg min-h-[100px]"></div>
                        <div id="payment-message" class="hidden mt-3 text-red-600 text-sm font-semibold"></div>

                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.order_notes') }}</label>
                            <textarea name="notes" rows="3" placeholder="{{ __('messages.special_instructions') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Pasūtījuma kopsavilkums -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">{{ __('messages.order_summary') }}</h2>

                        <div class="space-y-4 mb-6">
                            @foreach($cartItems as $item)
                            @php $price = $item->product->discount_price ?? $item->product->price; @endphp
                            <div class="flex gap-3">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                    class="w-16 h-16 object-cover rounded-lg flex-shrink-0 bg-gray-100">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $item->product->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">x{{ $item->quantity }}</p>
                                    <p class="text-sm font-bold text-emerald-600">€{{ number_format($price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t dark:border-gray-700 pt-4 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>{{ __('messages.subtotal') }}</span>
                                <span>€{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>{{ __('messages.shipping') }}</span>
                                <span>{{ $shipping == 0 ? __('messages.free') : '€' . number_format($shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>PVN (10%)</span>
                                <span>€{{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white border-t dark:border-gray-700 pt-3 mt-2">
                                <span>{{ __('messages.total') }}</span>
                                <span class="text-emerald-600">€{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" id="submit-btn"
                            class="w-full mt-6 bg-emerald-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-emerald-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span id="btn-text">Apmaksāt €{{ number_format($total, 2) }}</span>
                        </button>

                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-3">
                            🔒 Droši šifrēts savienojums ar Stripe
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ env("STRIPE_KEY") }}');
const clientSecret = '{{ $paymentIntent->client_secret }}';

const appearance = {
    theme: document.documentElement.classList.contains('dark') ? 'night' : 'stripe',
    variables: { colorPrimary: '#059669' }
};

const elements = stripe.elements({ appearance, clientSecret });
const paymentElement = elements.create('payment');
paymentElement.mount('#payment-element');

const form = document.getElementById('checkoutForm');
const submitBtn = document.getElementById('submit-btn');
const btnText = document.getElementById('btn-text');
const messageDiv = document.getElementById('payment-message');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    submitBtn.disabled = true;
    btnText.textContent = 'Apstrādā...';

    const { error, paymentIntent } = await stripe.confirmPayment({
        elements,
        confirmParams: { return_url: window.location.href },
        redirect: 'if_required'
    });

    if (error) {
        messageDiv.textContent = error.message;
        messageDiv.classList.remove('hidden');
        submitBtn.disabled = false;
        btnText.textContent = 'Apmaksāt €{{ number_format($total, 2) }}';
    } else if (paymentIntent && paymentIntent.status === 'succeeded') {
        document.getElementById('payment_intent_id').value = paymentIntent.id;
        form.submit();
    }
});
</script>
@endsection
