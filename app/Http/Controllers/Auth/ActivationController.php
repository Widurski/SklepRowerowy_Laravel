<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function activate(string $token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            abort(404);
        }

        $user->update([
            'email_verified_at' => now(),
            'activation_token'  => null,
        ]);

        Auth::login($user);

        return redirect()->route('client.dashboard')->with('success', 'Konto zostało aktywowane. Witaj w RowerOwo!');
    }
}
