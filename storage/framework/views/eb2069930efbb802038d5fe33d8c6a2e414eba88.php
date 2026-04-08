

<?php $__env->startPush('styles'); ?>
<style>
    .admin-login-topbar .top-mini-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: nowrap;
    }

    .admin-login-topbar .login-access-card {
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
        flex: 1;
        max-width: 320px;
    }

    .admin-login-topbar .login-access-card i {
        color: var(--primary);
    }

    .admin-login-topbar .mini-chip-group {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: nowrap;
        flex-shrink: 0;
    }

    .admin-login-topbar .mini-chip {
        white-space: nowrap;
        flex: 0 0 auto;
    }

    @media (max-width: 991.98px) {
        .admin-login-topbar .top-mini-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .admin-login-topbar .login-access-card {
            width: 100%;
            max-width: 100%;
            justify-content: flex-start;
        }

        .admin-login-topbar .mini-chip-group {
            justify-content: flex-start;
            flex-wrap: wrap;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-card row g-0">
    <div class="col-lg-5">
        <div class="auth-side">
            <div class="auth-brand">
                <span class="auth-brand-icon">
                    <img src="<?php echo e(asset('images/logo-sekolah.png')); ?>" alt="Logo Sekolah" class="school-logo">
                </span>
                <span>Admin Panel</span>
            </div>

            <div class="auth-pill">
                <i class="bi bi-stars"></i>
                Portal Pengelolaan Aspirasi
            </div>

            <h1 class="auth-title">
                Kelola laporan sarana sekolah dari satu panel admin.
            </h1>

            <p class="auth-desc">
                Website ini membantu admin memeriksa aspirasi siswa, memperbarui status penanganan,
                menambahkan feedback, dan memantau progres perbaikan sarana sekolah secara terpusat.
            </p>

            <div class="auth-feature-list">
                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="bi bi-kanban"></i>
                    </div>
                    <div>
                        <strong>Kelola laporan siswa</strong>
                        <span>Semua aspirasi yang masuk dapat dipantau dan diatur dari dashboard admin.</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="bi bi-clipboard-data"></i>
                    </div>
                    <div>
                        <strong>Update status penanganan</strong>
                        <span>Admin dapat mengubah status laporan menjadi menunggu, proses, atau selesai.</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="bi bi-check2-square"></i>
                    </div>
                    <div>
                        <strong>Berikan feedback yang jelas</strong>
                        <span>Setiap tindak lanjut dan catatan progres dapat langsung dilihat oleh siswa.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="auth-main admin-login-topbar">
            <div class="top-mini-bar">
                <div class="login-access-card">
                    <i class="bi bi-shield-check"></i>
                    <span>Akses login khusus admin</span>
                </div>

                <div class="mini-chip-group">
                    <div class="mini-chip">
                        <i class="bi bi-shield-check"></i>
                        Secure Panel
                    </div>
                    <div class="mini-chip">
                        <i class="bi bi-person-gear"></i>
                        Administrator
                    </div>
                </div>
            </div>

            <div class="login-panel">
                <div class="login-kicker">Sistem Pengaduan Sarana</div>
                <h2 class="login-title">Login Admin</h2>
                <p class="login-subtitle">
                    Masuk menggunakan username dan password admin untuk mengakses dashboard
                    pengelolaan aspirasi siswa dan memperbarui progres penanganan.
                </p>

                <form method="post" action="<?php echo e(route('admin.authenticate')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-workspace"></i>
                            </span>
                            <input
                                type="text"
                                name="username"
                                value="<?php echo e(old('username')); ?>"
                                class="form-control"
                                placeholder="Masukkan username admin"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required
                            >
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk sebagai Admin
                        </button>
                    </div>

                    <div class="d-grid mt-3">
                        <a href="<?php echo e(route('siswa.login')); ?>" class="btn btn-soft">
                            <i class="bi bi-mortarboard me-2"></i>
                            Login sebagai Siswa
                        </a>
                    </div>
                </form>

                <div class="helper-card">
                    <div class="helper-card-title">Akses Admin</div>
                    <p class="mb-0 text-muted" style="line-height: 1.7;">
                        Gunakan akun admin yang sudah terdaftar untuk mengelola laporan siswa,
                        memperbarui status, dan memberikan feedback tindak lanjut.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Login Admin'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/auth/admin-login.blade.php ENDPATH**/ ?>