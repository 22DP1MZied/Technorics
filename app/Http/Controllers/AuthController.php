<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('home')->with('success', 'Welcome to Technorics! Check your email for a special welcome message.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Debug logging
            Log::info('User logged in', [
                'email' => Auth::user()->email,
                'is_admin' => Auth::user()->is_admin,
                'is_admin_type' => gettype(Auth::user()->is_admin)
            ]);
            
            // Redirect admin users to admin panel
            if (Auth::user()->is_admin == true || Auth::user()->is_admin == 1) {
                Log::info('Redirecting to admin panel');
                return redirect('/admin')->with('success', 'Welcome to Admin Panel!');
            }
            
            Log::info('Redirecting to home');
            return redirect()->intended(route('home'))->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }
}
