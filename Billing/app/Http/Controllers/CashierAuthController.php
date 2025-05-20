<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CashierAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('cashier.login'); // The view with the custom login form
    }

    public function login(Request $request)
    {

        // Validate login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the cashier by email
        $cashier = Cashier::where('email', $request->email)->first();

        // Check if cashier exists and password matches
        if ($cashier && Hash::check($request->password, $cashier->password)) {
            // Save the cashier's ID in the session (acting as authentication)
            Session::put('cashier_id', $cashier->id);
             // Store cashier's name in the session for later use (for the welcome message)
             session(['cashierName' => $cashier->name]);
             session(['company' => $cashier->company]);
            // Redirect to the cashier dashboard or homepage
            return redirect('/product#section3');
        } else {
            // Invalid credentials
            return back()->withErrors(['message' => 'Invalid login credentials']);
        }
    }

    public function logout()
    {
        // Log the cashier out by clearing the session
        Session::forget('cashier_id');
        return redirect('/cashier-login');
    }

    public function showRegisterForm()
    {
        return view('cashier.register'); // Return the register view
    }

    public function register(Request $request)
    {
        // Validate the registration data
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:cashiers',
            'password' => 'required|string|min:8|confirmed', // Ensure password and confirmation match
        ]);

        // Create a new cashier and save to the database
        $cashier = new Cashier();
        $cashier->company = $request->company;
        $cashier->name = $request->name;
        $cashier->email = $request->email;
        $cashier->password = Hash::make($request->password); // Hash the password
        $cashier->save();

        // Redirect to login page or dashboard
        return redirect('/cashier-login')->with('success', 'Registration successful! You can now login.');
    }
}

