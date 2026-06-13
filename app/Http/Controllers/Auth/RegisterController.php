<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ActivationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
        ], [
            'name.regex'     => 'Imię może zawierać tylko litery, spacje i myślniki.',
            'password.regex' => 'Hasło musi zawierać co najmniej jedną małą literę, jedną wielką literę i jedną cyfrę.',
        ]);

        $token = Str::random(64);

        $user = User::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'role'             => 'client',
            'activation_token' => $token,
        ]);

        Mail::to($user->email)->send(new ActivationMail($user));

        return redirect()->route('activation.sent')
            ->with('activation_email', $user->email);
    }
}
