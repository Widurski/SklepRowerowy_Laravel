<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Nieprawidłowy e-mail lub hasło',
            ])->onlyInput('email');
        }

        if (!auth()->user()->email_verified_at) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Konto nie zostało aktywowane. Sprawdź swoją skrzynkę e-mail.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $role = auth()->user()->role;

        if ($role === 'administrator') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'kierownik') {
            return redirect()->route('kierownik.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
