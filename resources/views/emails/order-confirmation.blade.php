<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
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
        .order-details {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
        }
        .total-row.final {
            border-top: 2px solid #059669;
            margin-top: 10px;
            padding-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #059669;
        }
        .button {
            display: inline-block;
            background: #059669;
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
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #fef3c7;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 32px;">Order Confirmed! ✅</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Thank you for your order</p>
    </div>
    
    <div class="content">
        <h2>Hi {{ $order->shipping_name }}! 👋</h2>
        
        <p>Great news! We've received your order and we're getting it ready for shipment.</p>
        
        <div class="order-details">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div>
                    <strong>Order Number:</strong> {{ $order->order_number }}<br>
                    <strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}
                </div>
                <span class="status-badge">{{ ucfirst($order->status) }}</span>
            </div>
            
            <div style="border-top: 1px solid #e5e7eb; padding-top: 15px; margin-top: 15px;">
                <strong>Shipping Address:</strong><br>
                {{ $order->shipping_address }}<br>
                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>
                {{ $order->shipping_country }}
            </div>
        </div>
        
        <h3>Order Items</h3>
        <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px;">
            @foreach($order->items as $item)
            <div class="order-item">
                <div>
                    <strong>{{ $item->product->name }}</strong><br>
                    <span style="color: #6b7280; font-size: 14px;">Quantity: {{ $item->quantity }}</span>
                </div>
                <div style="text-align: right;">
                    <strong>€{{ number_format($item->total, 2) }}</strong>
                </div>
            </div>
            @endforeach
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e5e7eb;">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>€{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Shipping:</span>
                    <span>€{{ number_format($order->shipping, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Tax:</span>
                    <span>€{{ number_format($order->tax, 2) }}</span>
                </div>
                <div class="total-row final">
                    <span>Total:</span>
                    <span>€{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('orders.show', $order) }}" class="button">View Order Details</a>
        </div>
        
        <div style="background: #eff6ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong>📦 What's Next?</strong>
            <p style="margin: 10px 0 0 0;">We'll send you another email once your order ships with tracking information.</p>
        </div>
        
        <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">
            Questions about your order? Reply to this email or contact our support team.
        </p>
    </div>
    
    <div class="footer">
        <p><strong>Technorics</strong> - Your Tech Destination</p>
        <p>© {{ date('Y') }} Technorics. All rights reserved.</p>
    </div>
</body>
</html>
