<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        $title = "Register BKK";
        return view('auth.register', compact('title'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Checking if the email already exists
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Maaf, email Anda sudah terdaftar.');
        }

        // Checking if password and confirmation do not match
        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password tidak sama.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to a specific route after successful registration
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
