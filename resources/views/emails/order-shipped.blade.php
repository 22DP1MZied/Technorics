<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Shipped</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
        }
        .header {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .tracking-box {
            background: #faf5ff;
            border: 2px solid #8b5cf6;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
            text-align: center;
        }
        .tracking-number {
            font-size: 24px;
            font-weight: bold;
            color: #8b5cf6;
            letter-spacing: 2px;
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            background: #8b5cf6;
            color: white;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
        }
        .delivery-estimate {
            background: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div style="font-size: 64px; margin-bottom: 10px;">📦</div>
        <h1 style="margin: 0; font-size: 32px;">Your Order is On Its Way!</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Package shipped successfully</p>
    </div>
    
    <div class="content">
        <h2>Great News, {{ $order->shipping_name }}! 🎉</h2>
        
        <p>Your order <strong>{{ $order->order_number }}</strong> has been shipped and is on its way to you!</p>
        
        @if($trackingNumber)
        <div class="tracking-box">
            <div style="font-size: 14px; color: #6b7280; text-transform: uppercase; letter-spacing: 1px;">Tracking Number</div>
            <div class="tracking-number">{{ $trackingNumber }}</div>
            <a href="https://www.tracking-example.com/track/{{ $trackingNumber }}" class="button" style="margin-top: 15px;">Track Your Package</a>
        </div>
        @endif
        
        <div class="delivery-estimate">
            <strong>📅 Estimated Delivery</strong><br>
            <span style="font-size: 18px; color: #10b981;">{{ $order->created_at->addDays(3)->format('l, F j') }} - {{ $order->created_at->addDays(5)->format('l, F j') }}</span>
        </div>
        
        <div style="background: #f9fafb; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <strong>Shipping To:</strong><br>
            {{ $order->shipping_address }}<br>
            {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>
            {{ $order->shipping_country }}
        </div>
        
        <h3>What's in Your Package?</h3>
        <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px;">
            @foreach($order->items as $item)
            <div style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                <strong>{{ $item->product->name }}</strong><br>
                <span style="color: #6b7280; font-size: 14px;">Quantity: {{ $item->quantity }}</span>
            </div>
            @endforeach
        </div>
        
        <div style="background: #eff6ff; border: 1px solid #3b82f6; padding: 20px; margin: 25px 0; border-radius: 8px;">
            <strong style="color: #1e40af;">📱 Pro Tip:</strong>
            <p style="margin: 10px 0 0 0; color: #1e40af;">Save your tracking number and check your package status anytime in your order history.</p>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('orders.show', $order) }}" class="button">View Full Order Details</a>
        </div>
        
        <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">
            <strong>Questions about your delivery?</strong> Our support team is here to help!
        </p>
    </div>
    
    <div class="footer">
        <p><strong>Technorics</strong> - Your Tech Destination</p>
        <p>© {{ date('Y') }} Technorics. All rights reserved.</p>
    </div>
</body>
</html>
