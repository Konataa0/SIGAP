<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Middleware ini dipakai di web.php:
     *   Route::middleware(['role:admin'])->group(...)
     *
     * Anggota 3 akan kembangkan ini lebih lanjut dengan Gate & Policy.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Kalau belum login, arahkan ke login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        // Cek apakah role user ada di daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk: ' . implode(', ', $roles));
        }

        return $next($request);
    }
}