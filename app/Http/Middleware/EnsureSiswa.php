<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.login')
                ->with('error', 'Silakan login sebagai siswa terlebih dahulu.');
        }

        return $next($request);
    }
}
