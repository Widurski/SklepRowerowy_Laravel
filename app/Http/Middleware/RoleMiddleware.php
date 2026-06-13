<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        // jeśli użytkownik nie jest zalogowany - przekieruj do logowania
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // dozwolone role przekazane w trasie, np. "kierownik|administrator"
        $allowed = explode('|', $roles);

        // jeśli rola użytkownika nie pasuje - brak dostępu
        if (!in_array(auth()->user()->role, $allowed)) {
            abort(403, 'Brak dostępu.');
        }

        return $next($request);
    }
}
