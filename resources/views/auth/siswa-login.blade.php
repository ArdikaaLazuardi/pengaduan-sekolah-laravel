@extends('layouts.app', ['title' => 'Login Siswa'])

@push('styles')
<style>
    .login-access-card {
        min-height: 52px;
        padding: 0 18px;
        border-radius: 16px;
        background: #efede9;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #5d6663;
        font-size: .92rem;
        font-weight: 700;
    }

    .login-access-card i {
        color: var(--primary);
    }

    @media (max-width: 991.98px) {
        .login-access-card {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-card row g-0">
    <div class="col-lg-5">
        <div class="auth-side">
            <div class="auth-brand">
                <span class="auth-brand-icon">
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" class="school-logo">
                </span>
                <span>Pengaduan Sarana Sekolah</span>
            </div>

            <div class="auth-pill">
                <i class="bi bi-stars"></i>
                Portal Aspirasi Siswa
            </div>

            <h1 class="auth-title">
                Sampaikan keluhan sarana sekolah di satu portal siswa.
            </h1>

            <p class="auth-desc">
                Website ini digunakan untuk menyampaikan aspirasi, keluhan, atau laporan
                terkait sarana dan prasarana sekolah, lalu memantau proses penanganannya
                secara lebih jelas dan terstruktur.
            </p>

            <div class="auth-feature-list">
                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <div>
                        <strong>Kirim aspirasi dengan mudah</strong>
                        <span>Siswa dapat melaporkan fasilitas yang rusak atau membutuhkan perbaikan.</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <strong>Pantau status penanganan</strong>
                        <span>Lihat apakah laporan masih menunggu, sedang diproses, atau sudah selesai.</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <div>
                        <strong>Lihat feedback admin</strong>
                        <span>Setiap perkembangan penanganan dapat dipantau langsung dari dashboard siswa.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="auth-main">
            <div class="top-mini-bar">
                <div class="login-access-card">
                    <i class="bi bi-person-badge"></i>
                    <span>Akses login khusus siswa</span>
                </div>

                <div class="mini-chip-group">
                    <div class="mini-chip">
                        <i class="bi bi-calendar3"></i>
                        Portal Siswa
                    </div>
                    <div class="mini-chip">
                        <i class="bi bi-shield-check"></i>
                        Aman
                    </div>
                </div>
            </div>

            <div class="login-panel">
                <div class="login-kicker">Sistem Pengaduan Sarana</div>
                <h2 class="login-title">Login Siswa</h2>
                <p class="login-subtitle">
                    Masuk menggunakan NIS yang sudah terdaftar untuk mengakses dashboard siswa
                    dan memantau seluruh aspirasi yang pernah dikirim.
                </p>

                <form method="post" action="{{ route('siswa.authenticate') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nomor Induk Siswa (NIS)</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-badge"></i>
                            </span>
                            <input
                                type="text"
                                name="nis"
                                value="{{ old('nis') }}"
                                class="form-control"
                                placeholder="Contoh: 2025001"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk sebagai Siswa
                        </button>
                    </div>

                    <div class="d-grid mt-3">
                        <a href="{{ route('admin.login') }}" class="btn btn-soft">
                            <i class="bi bi-person-gear me-2"></i>
                            Login sebagai Admin
                        </a>
                    </div>
                </form>

                <div class="helper-card">
                    <div class="helper-card-title">Demo Seeder</div>
                    <div>
                        <span class="demo-badge">2025001</span>
                        <span class="demo-badge">2025002</span>
                        <span class="demo-badge">2025003</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection