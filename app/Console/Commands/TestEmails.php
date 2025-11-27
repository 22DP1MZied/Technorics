<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Order;
use App\Mail\WelcomeEmail;
use App\Mail\OrderConfirmationEmail;
use App\Mail\OrderStatusUpdateEmail;
use App\Mail\OrderShippedEmail;
use Illuminate\Support\Facades\Mail;

class TestEmails extends Command
{
    protected $signature = 'test:emails {type?}';
    protected $description = 'Test email templates';

    public function handle()
    {
        $type = $this->argument('type');

        if (!$type) {
            $type = $this->choice(
                'Which email would you like to test?',
                ['welcome', 'order-confirmation', 'order-status-update', 'order-shipped', 'all']
            );
        }

        $testEmail = $this->ask('Enter email address to send test to', 'test@example.com');

        $this->info("Sending test email(s) to: {$testEmail}");

        try {
            if ($type === 'welcome' || $type === 'all') {
                $user = User::first() ?? User::factory()->make(['name' => 'Test User', 'email' => $testEmail]);
                Mail::to($testEmail)->send(new WelcomeEmail($user));
                $this->info('✓ Welcome email sent');
            }

            if ($type === 'order-confirmation' || $type === 'all') {
                $order = Order::with('items.product')->first();
                if ($order) {
                    Mail::to($testEmail)->send(new OrderConfirmationEmail($order));
                    $this->info('✓ Order confirmation email sent');
                } else {
                    $this->warn('⚠ No orders found in database. Skipping order confirmation email.');
                }
            }

            if ($type === 'order-status-update' || $type === 'all') {
                $order = Order::with('items.product')->first();
                if ($order) {
                    Mail::to($testEmail)->send(new OrderStatusUpdateEmail($order, 'pending'));
                    $this->info('✓ Order status update email sent');
                } else {
                    $this->warn('⚠ No orders found in database. Skipping status update email.');
                }
            }

            if ($type === 'order-shipped' || $type === 'all') {
                $order = Order::with('items.product')->first();
                if ($order) {
                    Mail::to($testEmail)->send(new OrderShippedEmail($order, 'TRK-TEST123456'));
                    $this->info('✓ Order shipped email sent');
                } else {
                    $this->warn('⚠ No orders found in database. Skipping shipped email.');
                }
            }

            $this->info('');
            $this->info('✓ Test emails sent successfully!');
            $this->info('Check your inbox at: ' . $testEmail);

        } catch (\Exception $e) {
            $this->error('✗ Error sending emails: ' . $e->getMessage());
            $this->info('');
            $this->info('Troubleshooting tips:');
            $this->info('1. Make sure your mail configuration is correct in .env file');
            $this->info('2. If using Gmail, make sure you created an App Password');
            $this->info('3. Check if your Gmail account has 2-factor authentication enabled');
        }

        return 0;
    }
}
