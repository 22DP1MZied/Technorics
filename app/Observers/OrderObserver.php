<?php

namespace App\Observers;

use App\Models\Order;
use App\Mail\OrderStatusUpdateEmail;
use App\Mail\OrderShippedEmail;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    public function updated(Order $order)
    {
        // Check if status was changed
        if ($order->isDirty('status')) {
            $oldStatus = $order->getOriginal('status');
            $newStatus = $order->status;

            // Send status update email
            Mail::to($order->shipping_email)->send(new OrderStatusUpdateEmail($order, $oldStatus));

            // If order was marked as shipped, send special shipped email
            if ($newStatus === 'shipped') {
                // You can add tracking number logic here if you have it
                $trackingNumber = 'TRK-' . strtoupper(uniqid());
                Mail::to($order->shipping_email)->send(new OrderShippedEmail($order, $trackingNumber));
            }
        }
    }
}
