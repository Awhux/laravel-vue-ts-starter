<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;

class LoginController extends Controller
{
  public function index(Request $request)
  {
    return Inertia::render('Auth/Login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email', 'max:255'],
      'password' => ['required', 'min:8', 'max:255'],
      'remember' => ['boolean', 'nullable'],
    ]);

    if (auth()->attempt([
      'email' => $credentials['email'],
      'password' => $credentials['password'],
    ], $credentials['remember'] ?? false)) {
      $request->session()->regenerate();

      return redirect()->route('home');
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }
}
