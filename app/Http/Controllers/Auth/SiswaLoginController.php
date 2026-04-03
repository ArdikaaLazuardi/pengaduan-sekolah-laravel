<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SiswaLoginRequest;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SiswaLoginController extends Controller
{
    public function create(): View
    {
        return view('auth.siswa-login');
    }

    public function store(SiswaLoginRequest $request): RedirectResponse
    {
        $siswa = Siswa::query()->findOrFail($request->validated('nis'));

        Auth::guard('siswa')->login($siswa, remember: true);
        $request->session()->regenerate();

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Login siswa berhasil.');
    }
}
