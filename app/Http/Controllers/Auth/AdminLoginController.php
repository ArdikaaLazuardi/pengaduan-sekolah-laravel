<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    public function create(): View
    {
        return view('auth.admin-login');
    }

    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (! Auth::guard('admin')->attempt($credentials, remember: true)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Username atau password admin salah.',
                ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Login admin berhasil.');
    }
}
