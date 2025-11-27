<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Technorics</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
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
            padding: 40px 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
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
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 30px 0;
        }
        .feature {
            flex: 1;
            min-width: 200px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
        }
        .feature-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 32px;">Welcome to Technorics! 🎉</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Your journey to amazing tech starts here</p>
    </div>
    
    <div class="content">
        <h2>Hi {{ $user->name }}! 👋</h2>
        
        <p>We're thrilled to have you join the Technorics family! You've just unlocked access to the best deals on laptops, gaming gear, and cutting-edge technology.</p>
        
        <div class="features">
            <div class="feature">
                <div class="feature-icon">🚚</div>
                <h3 style="margin: 10px 0;">Free Shipping</h3>
                <p style="margin: 5px 0; color: #6b7280;">On orders over €100</p>
            </div>
            <div class="feature">
                <div class="feature-icon">⚡</div>
                <h3 style="margin: 10px 0;">Fast Delivery</h3>
                <p style="margin: 5px 0; color: #6b7280;">2-3 business days</p>
            </div>
            <div class="feature">
                <div class="feature-icon">🎁</div>
                <h3 style="margin: 10px 0;">Exclusive Deals</h3>
                <p style="margin: 5px 0; color: #6b7280;">Member-only offers</p>
            </div>
        </div>
        
        <p><strong>Here's what you can do now:</strong></p>
        <ul>
            <li>Browse our latest collection of laptops and gaming gear</li>
            <li>Add items to your wishlist for later</li>
            <li>Check out our flash deals and special offers</li>
            <li>Track your orders in real-time</li>
        </ul>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('store.index') }}" class="button">Start Shopping Now</a>
        </div>
        
        <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280;">
            Need help? Our support team is here for you 24/7. Just reply to this email or visit our help center.
        </p>
    </div>
    
    <div class="footer">
        <p><strong>Technorics</strong> - Your Tech Destination</p>
        <p>© {{ date('Y') }} Technorics. All rights reserved.</p>
    </div>
</body>
</html>
