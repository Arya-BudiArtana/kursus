<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @param string $role // <-- Ini adalah parameter 'admin' atau 'user'
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah 'role' user yang login SAMA DENGAN 'role' yang diminta
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika tidak, lempar ke halaman error 403 (Forbidden/Dilarang)
            abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
        }
        // Jika lolos, lanjutkan request ke controller
        return $next($request);
    }
}
