<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Middleware ini dipakai di web.php:
     *   Route::middleware(['role:admin'])->group(...)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Kalau belum login, arahkan ke login.
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userRole = $user->role;

        // Cek apakah role user ada di daftar role yang diizinkan.
        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk: ' . implode(', ', $roles));
        }

        return $next($request);
    }
}
