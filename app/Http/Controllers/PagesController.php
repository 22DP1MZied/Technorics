<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // Send email - renamed 'message' to 'userMessage' to avoid conflict
            Mail::send('emails.contact', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'userMessage' => $validated['message'], // Renamed to avoid conflict with Mail $message
            ], function ($message) use ($validated) {
                $message->to('noreply.technorics@gmail.com')
                        ->subject('Contact Form: ' . $validated['subject'])
                        ->replyTo($validated['email'], $validated['name']);
            });

            Log::info('Contact form email sent successfully');

            return back()->with('success', '✅ Thank you for contacting us! Your message has been sent successfully. We will get back to you within 24 hours.');
            
        } catch (\Exception $e) {
            Log::error('Contact form email error: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'There was an error sending your message. Please try again or email us directly at noreply.technorics@gmail.com']);
        }
    }

    public function trackOrder()
    {
        return view('pages.track-order');
    }

    public function returns()
    {
        return view('pages.returns');
    }

    public function shipping()
    {
        return view('pages.shipping');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function careers()
    {
        return view('pages.careers');
    }

    public function press()
    {
        return view('pages.press');
    }

    public function blog()
    {
        return view('pages.blog');
    }
}
