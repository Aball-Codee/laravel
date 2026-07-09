<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AgeMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->usia >= 18) {
            return $next($request);
        }

        return redirect('/home')
            ->with('error', 'Maaf, halaman ini hanya dapat diakses oleh pengguna berusia minimal 18 tahun.');
    }
}