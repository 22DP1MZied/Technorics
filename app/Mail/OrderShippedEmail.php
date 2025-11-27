<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShippedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $trackingNumber;

    public function __construct(Order $order, $trackingNumber = null)
    {
        $this->order = $order;
        $this->trackingNumber = $trackingNumber;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Has Been Shipped! 📦 - ' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-shipped',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
