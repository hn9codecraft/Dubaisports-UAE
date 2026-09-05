<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Order has been Shipped</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8f9fa; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background-color: #ed2124; padding: 30px 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .content h2 { color: #ed2124; margin-top: 0; }
        .content p { line-height: 1.6; font-size: 16px; }
        .order-details { background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 4px; padding: 15px; margin: 20px 0; }
        .order-details ul { list-style: none; padding: 0; margin: 0; }
        .order-details li { padding: 8px 0; border-bottom: 1px solid #e9ecef; }
        .order-details li:last-child { border-bottom: none; }
        .btn { display: inline-block; background-color: #ed2124; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; margin-top: 20px; text-align: center; }
        .footer { background-color: #f1f3f5; padding: 20px; text-align: center; font-size: 14px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name', 'Dubai Sports') }}</h1>
        </div>
        
        <div class="content">
            <h2>Great news, {{ $order->user->first_name ?? 'Customer' }}!</h2>
            <p>Your order <strong>#{{ $order->id }}</strong> has just been shipped and is on its way to you.</p>
            
            <div class="order-details">
                <strong>Order Summary:</strong>
                <ul>
                    @php
                        $products = json_decode($order->products, true);
                    @endphp
                    @if(is_array($products))
                        @foreach($products as $item)
                            <li>
                                {{ $item['quantity'] ?? 1 }}x {{ $item['product']['title'] ?? 'Product' }} 
                                @if(!empty($item['selectedVariant']))
                                    <small>({{ $item['selectedVariant'] }})</small>
                                @endif
                                - AED {{ number_format(($item['productDiscountPrice'] ?? $item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}
                            </li>
                        @endforeach
                    @endif
                </ul>
                <div style="margin-top: 15px; text-align: right; font-weight: bold;">
                    Total: AED {{ number_format($order->getPayment->price ?? 0, 2) }}
                </div>
            </div>
            
            <p>You can track your order status by visiting your account.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('front.orders.index') }}" style="display: inline-block; background-color: #ed2124; color: #ffffff !important; text-decoration: none; padding: 12px 25px; border-radius: 4px; font-weight: bold; margin-top: 20px; text-align: center;">View My Orders</a>
            </div>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name', 'Dubai Sports') }}. All rights reserved.<br>
            If you have any questions, reply to this email or contact our support team.
        </div>
    </div>
</body>
</html>
