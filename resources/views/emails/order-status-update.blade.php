<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update</title>
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
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
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
        .status-timeline {
            margin: 30px 0;
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
        }
        .status-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            position: relative;
        }
        .status-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 15px;
        }
        .status-icon.completed {
            background: #10b981;
            color: white;
        }
        .status-icon.current {
            background: #3b82f6;
            color: white;
        }
        .status-icon.pending {
            background: #e5e7eb;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            background: #3b82f6;
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
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 32px;">Order Update 📦</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">{{ $order->order_number }}</p>
    </div>
    
    <div class="content">
        <h2>Hi {{ $order->shipping_name }}!</h2>
        
        <p>Your order status has been updated:</p>
        
        <div style="background: #eff6ff; border-left: 4px solid #3b82f6; padding: 20px; margin: 20px 0; border-radius: 4px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="color: #6b7280; font-size: 14px;">Status Changed From</div>
                    <strong style="font-size: 18px; color: #6b7280;">{{ ucfirst($oldStatus) }}</strong>
                </div>
                <div style="font-size: 24px;">→</div>
                <div>
                    <div style="color: #3b82f6; font-size: 14px;">Status Changed To</div>
                    <strong style="font-size: 18px; color: #3b82f6;">{{ ucfirst($order->status) }}</strong>
                </div>
            </div>
        </div>
        
        <div class="status-timeline">
            <h3>Order Progress</h3>
            
            <div class="status-item">
                <div class="status-icon completed">✓</div>
                <div>
                    <strong>Order Placed</strong><br>
                    <span style="color: #6b7280; font-size: 14px;">{{ $order->created_at->format('M j, Y g:i A') }}</span>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-icon {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : ($order->status === 'pending' ? 'current' : 'pending') }}">
                    {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? '✓' : '⏳' }}
                </div>
                <div>
                    <strong>Processing</strong><br>
                    <span style="color: #6b7280; font-size: 14px;">Preparing your order</span>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-icon {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : ($order->status === 'processing' ? 'current' : 'pending') }}">
                    {{ in_array($order->status, ['shipped', 'delivered']) ? '✓' : '📦' }}
                </div>
                <div>
                    <strong>Shipped</strong><br>
                    <span style="color: #6b7280; font-size: 14px;">On the way to you</span>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-icon {{ $order->status === 'delivered' ? 'completed' : ($order->status === 'shipped' ? 'current' : 'pending') }}">
                    {{ $order->status === 'delivered' ? '✓' : '🏠' }}
                </div>
                <div>
                    <strong>Delivered</strong><br>
                    <span style="color: #6b7280; font-size: 14px;">Enjoy your purchase!</span>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('orders.show', $order) }}" class="button">View Order Details</a>
        </div>
        
        @if($order->status === 'delivered')
        <div style="background: #f0fdf4; border: 1px solid #86efac; padding: 20px; margin: 20px 0; border-radius: 8px; text-align: center;">
            <strong style="color: #15803d;">🎉 Your order has been delivered!</strong>
            <p style="margin: 10px 0 0 0; color: #15803d;">We hope you love your purchase! Don't forget to leave a review.</p>
        </div>
        @endif
        
        <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">
            Need help? Contact our support team anytime.
        </p>
    </div>
    
    <div class="footer">
        <p><strong>Technorics</strong> - Your Tech Destination</p>
        <p>© {{ date('Y') }} Technorics. All rights reserved.</p>
    </div>
</body>
</html>
