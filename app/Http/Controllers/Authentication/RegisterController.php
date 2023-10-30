<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:255'],
            'password_confirmation' => ['required', 'same:password'],
            // 'csrf_token' => 'required|csrf',
        ]);

        $user = \App\Models\User::create($credentials);

        if ($user) {
            auth()->login($user);

            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
