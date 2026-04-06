<!doctype html>
<html lang="id">
<?php
    $isGuestPage = request()->routeIs('siswa.login') || request()->routeIs('admin.login');
    $isAdmin = auth('admin')->check();
    $isSiswa = auth('siswa')->check();

    $currentUserName = $isAdmin
        ? auth('admin')->user()->username
        : ($isSiswa ? auth('siswa')->user()->nama : 'Guest');

    $currentUserSub = $isAdmin
        ? 'Administrator'
        : ($isSiswa ? 'NIS ' . auth('siswa')->user()->nis : 'Visitor');

    $topbarLabel = $isSiswa
        ? 'Portal Siswa'
        : ($isAdmin ? 'Portal Admin' : ($title ?? 'Dashboard'));
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Pengaduan Sarana Sekolah'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --bg-main: #7fa38e;
            --bg-main-dark: #6d8f7d;
            --app-surface: #f4f2ee;
            --app-surface-2: #fbfaf8;
            --card: #ffffff;
            --primary: #0f4f4b;
            --primary-dark: #0b3d3a;
            --primary-soft: #d8ebe6;
            --text-main: #1f2a2a;
            --text-soft: #7b8581;
            --border-soft: #ebe7e1;
            --shadow-main: 0 22px 70px rgba(20, 38, 35, 0.12);
            --shadow-card: 0 12px 34px rgba(20, 38, 35, 0.08);
            --radius-xl: 34px;
            --radius-lg: 24px;
            --radius-md: 18px;
            --radius-sm: 14px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,.16), transparent 18%),
                radial-gradient(circle at bottom right, rgba(255,255,255,.14), transparent 22%),
                linear-gradient(135deg, var(--bg-main) 0%, var(--bg-main-dark) 100%);
        }

        body.auth-page-body,
        body.app-page-body {
            min-height: 100vh;
        }

        .page-frame {
            min-height: 100vh;
            padding: 24px;
        }

        .app-shell {
            min-height: calc(100vh - 48px);
            background: var(--app-surface);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-main);
            overflow: hidden;
        }

        .alert {
            border: 0;
            border-radius: 18px;
            box-shadow: var(--shadow-card);
        }

        .card-soft {
            background: var(--card);
            border: 1px solid rgba(15, 79, 75, 0.06);
            border-radius: 24px;
            box-shadow: var(--shadow-card);
        }

        .form-label {
            font-size: .92rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-main);
        }

        .form-control,
        .form-select {
            min-height: 54px;
            border-radius: 16px;
            border: 1px solid var(--border-soft);
            background: #fff;
            box-shadow: none;
            padding-left: 16px;
            padding-right: 16px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 79, 75, .35);
            box-shadow: 0 0 0 4px rgba(15, 79, 75, .10);
        }

        .input-group-text {
            min-height: 54px;
            border-radius: 16px 0 0 16px;
            border: 1px solid var(--border-soft);
            border-right: 0;
            background: #fff;
            color: var(--text-soft);
            padding: 0 16px;
        }

        .input-group .form-control,
        .input-group .form-select {
            border-left: 0;
            border-radius: 0 16px 16px 0;
        }

        .btn {
            border-radius: 16px;
            font-weight: 700;
            padding: 12px 18px;
            transition: .2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            border: 0;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 12px 24px rgba(15, 79, 75, .18);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(180deg, #11615b 0%, #0b3d3a 100%);
        }

        .btn-soft {
            background: #ece8e2;
            border: 0;
            color: var(--primary);
        }

        .btn-soft:hover {
            background: #e5e0d9;
            color: var(--primary-dark);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: .82rem;
            font-weight: 700;
        }

        .status-menunggu {
            background: #ece9e4;
            color: #6b7280;
        }

        .status-proses {
            background: #fff3cd;
            color: #a16207;
        }

        .status-selesai {
            background: #dcfce7;
            color: #166534;
        }

        .table-modern {
            margin-bottom: 0;
        }

        .table-modern thead th {
            border-bottom: 1px solid var(--border-soft);
            color: var(--text-soft);
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 800;
            padding: 16px 18px;
            white-space: nowrap;
        }

        .table-modern tbody td {
            padding: 16px 18px;
            border-color: #f0ece6;
            vertical-align: middle;
        }

        .table-modern tbody tr:hover {
            background: rgba(15, 79, 75, 0.03);
        }

        .pagination {
            --bs-pagination-border-radius: 14px;
            --bs-pagination-color: var(--primary);
            --bs-pagination-border-color: var(--border-soft);
            --bs-pagination-hover-color: var(--primary-dark);
            --bs-pagination-hover-bg: #f2efea;
            --bs-pagination-hover-border-color: var(--border-soft);
            --bs-pagination-active-bg: var(--primary);
            --bs-pagination-active-border-color: var(--primary);
            --bs-pagination-focus-box-shadow: 0 0 0 0.2rem rgba(15,79,75,.12);
        }

        /* TOAST */
        .toast-stack {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 3000;
            display: flex;
            flex-direction: column;
            gap: 12px;
            pointer-events: none;
        }

        .app-toast {
            min-width: 280px;
            max-width: 360px;
            padding: 14px 16px;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
            border: 1px solid rgba(15, 79, 75, 0.08);
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: flex-start;
            gap: 12px;
            pointer-events: auto;
            transition: opacity .3s ease, transform .3s ease;
        }

        .app-toast.hide {
            opacity: 0;
            transform: translateY(-8px);
        }

        .app-toast-icon {
            width: 38px;
            height: 38px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .app-toast-success .app-toast-icon {
            background: #dcfce7;
            color: #166534;
        }

        .app-toast-error .app-toast-icon {
            background: #fee2e2;
            color: #b91c1c;
        }

        .app-toast-body {
            min-width: 0;
        }

        .app-toast-title {
            font-size: .9rem;
            font-weight: 800;
            margin-bottom: 2px;
            color: var(--text-main);
        }

        .app-toast-text {
            font-size: .88rem;
            line-height: 1.5;
            color: #52615d;
            word-break: break-word;
        }

        /* AUTH */
        .auth-shell {
            min-height: calc(100vh - 48px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
        }

        .auth-window {
            width: 100%;
            max-width: 1080px;
            background: var(--app-surface);
            border-radius: var(--radius-xl);
            padding: 18px;
            box-shadow: var(--shadow-main);
        }

        .auth-card {
            background: var(--app-surface-2);
            border: 1px solid rgba(15, 79, 75, 0.06);
            border-radius: 28px;
            overflow: hidden;
        }

        .auth-side {
            min-height: 620px;
            padding: 36px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,.14), transparent 25%),
                linear-gradient(180deg, #0f4f4b 0%, #0b3d3a 100%);
            color: #fff;
            position: relative;
        }

        .auth-side::before {
            content: "";
            position: absolute;
            right: -40px;
            top: 40px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
        }

        .auth-side::after {
            content: "";
            position: absolute;
            left: -20px;
            bottom: -30px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
        }

        .auth-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 28px;
        }

        .auth-brand-icon {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.12);
            font-size: 1.15rem;
        }

        .auth-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.12);
            font-size: .85rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .auth-title {
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 14px;
        }

        .auth-desc {
            font-size: .98rem;
            line-height: 1.75;
            color: rgba(255,255,255,.78);
            max-width: 480px;
            margin-bottom: 26px;
        }

        .auth-feature-list {
            display: grid;
            gap: 14px;
            margin-top: 28px;
        }

        .auth-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 20px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.10);
            backdrop-filter: blur(8px);
        }

        .auth-feature-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.14);
            flex-shrink: 0;
        }

        .auth-feature-item strong {
            display: block;
            font-size: .95rem;
            margin-bottom: 4px;
        }

        .auth-feature-item span {
            font-size: .88rem;
            color: rgba(255,255,255,.72);
            line-height: 1.6;
        }

        .auth-main {
            min-height: 620px;
            padding: 34px;
            background: var(--app-surface-2);
        }

        .top-mini-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 28px;
        }

        .fake-search {
            height: 52px;
            background: #efede9;
            border-radius: 16px;
            padding: 0 16px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #8a8f8b;
            min-width: 250px;
            font-size: .92rem;
        }

        .mini-chip-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .mini-chip {
            height: 44px;
            padding: 0 16px;
            border-radius: 14px;
            background: #efede9;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #596361;
            font-size: .85rem;
            font-weight: 600;
        }

        .login-panel {
            max-width: 420px;
            margin: 28px auto 0;
        }

        .login-kicker {
            color: var(--primary);
            font-size: .82rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .login-title {
            font-size: 2rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: var(--text-soft);
            line-height: 1.7;
            margin-bottom: 26px;
        }

        .helper-card {
            margin-top: 22px;
            padding: 18px;
            background: #f2efea;
            border-radius: 20px;
            border: 1px solid var(--border-soft);
        }

        .helper-card-title {
            font-size: .82rem;
            color: var(--text-soft);
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .demo-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--border-soft);
            font-size: .88rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0 8px 8px 0;
        }

        /* APP */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            min-height: calc(100vh - 48px);
        }

        .dashboard-sidebar {
            background: #f8f6f2;
            border-right: 1px solid rgba(15,79,75,.06);
            padding: 28px 18px 22px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 8px 18px;
            margin-bottom: 14px;
        }

        .sidebar-brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 16px;
            background: var(--primary);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 24px rgba(15,79,75,.18);
        }

        .sidebar-brand-text {
            font-weight: 800;
            font-size: 1.05rem;
            letter-spacing: -0.02em;
            color: var(--primary);
        }

        .sidebar-brand-text small {
            display: block;
            font-weight: 600;
            color: var(--text-soft);
            font-size: .76rem;
            margin-top: 2px;
        }

        .sidebar-menu {
            display: grid;
            gap: 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 54px;
            padding: 0 16px;
            border-radius: 16px;
            color: #5c6461;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .sidebar-link:hover {
            background: #efebe5;
            color: var(--primary-dark);
        }

        .sidebar-link.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 12px 24px rgba(15,79,75,.14);
        }

        .sidebar-link i {
            font-size: 1rem;
        }

        .sidebar-bottom-card {
            margin-top: auto;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,.18), transparent 22%),
                linear-gradient(180deg, #0f4f4b 0%, #0b3d3a 100%);
            color: #fff;
            border-radius: 24px;
            padding: 20px;
            box-shadow: 0 16px 30px rgba(15,79,75,.18);
        }

        .sidebar-bottom-card .mini-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 14px;
            border-radius: 999px;
            background: #fff;
            color: var(--primary);
            font-weight: 800;
            font-size: .85rem;
            text-decoration: none;
        }

        .dashboard-main {
            padding: 18px;
            background: var(--app-surface);
        }

        .dashboard-content {
            min-height: 100%;
            background: var(--app-surface-2);
            border-radius: 30px;
            border: 1px solid rgba(15,79,75,.05);
            padding: 18px;
        }

        .dashboard-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }

        .topbar-search {
            min-height: 52px;
            max-width: 380px;
            width: 100%;
            background: #efede9;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 0 18px;
            color: #5d6663;
            font-weight: 700;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.45);
        }

        .topbar-search i {
            color: var(--primary);
            font-size: 1rem;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .topbar-chip {
            min-height: 44px;
            padding: 0 16px;
            border-radius: 14px;
            background: #efede9;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: .85rem;
            font-weight: 700;
            color: #5d6663;
        }

        .user-badge {
            min-height: 48px;
            padding: 8px 14px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-card);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 14px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .user-meta {
            line-height: 1.1;
        }

        .user-meta strong {
            display: block;
            font-size: .9rem;
        }

        .user-meta span {
            color: var(--text-soft);
            font-size: .75rem;
            font-weight: 600;
        }

        .logout-btn {
            min-height: 48px;
            width: 48px;
            border: 0;
            border-radius: 16px;
            background: #efede9;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* NO WHITE SPACE / FULLSCREEN BEHAVIOR */
        .app-page-body {
            overflow: hidden;
        }

        .app-page-body .page-frame {
            height: 100vh;
            overflow: hidden;
            padding: 24px;
        }

        .app-page-body .app-shell {
            height: calc(100vh - 48px);
            min-height: calc(100vh - 48px);
            overflow: hidden;
        }

        .app-page-body .dashboard-layout {
            height: 100%;
            min-height: 100%;
        }

        .app-page-body .dashboard-sidebar {
            height: 100%;
            overflow: hidden;
        }

        .app-page-body .dashboard-main {
            height: 100%;
            overflow: hidden;
            padding: 18px;
        }

        .app-page-body .dashboard-content {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 30px;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }

        .auth-page-body {
            overflow: hidden;
        }

        .auth-page-body .page-frame {
            height: 100vh;
            overflow: hidden;
            padding: 24px;
        }

        .auth-page-body .auth-shell {
            height: calc(100vh - 48px);
            min-height: calc(100vh - 48px);
            padding: 0;
        }

        .auth-page-body .auth-window {
            height: 100%;
            max-height: 100%;
            overflow: hidden;
        }

        .auth-page-body .auth-card {
            height: 100%;
        }

        .auth-page-body .auth-side,
        .auth-page-body .auth-main {
            height: 100%;
            min-height: 100%;
        }

        .auth-page-body .auth-main {
            overflow-y: auto;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .dashboard-content > :last-child,
        .auth-main > :last-child,
        .auth-side > :last-child {
            margin-bottom: 0 !important;
        }

        @media (max-width: 1199.98px) {
            .dashboard-layout {
                grid-template-columns: 220px minmax(0, 1fr);
            }
        }

        @media (max-width: 991.98px) {
            .page-frame {
                padding: 14px;
            }

            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                border-right: 0;
                border-bottom: 1px solid rgba(15,79,75,.06);
            }

            .dashboard-topbar,
            .top-mini-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .topbar-search,
            .fake-search {
                max-width: 100%;
            }

            .auth-side,
            .auth-main {
                min-height: auto;
                padding: 24px;
            }

            .login-panel {
                margin-top: 8px;
            }

            .app-page-body,
            .auth-page-body {
                overflow-y: auto;
            }

            .app-page-body .page-frame,
            .auth-page-body .page-frame {
                height: auto;
                min-height: 100vh;
                overflow: visible;
                padding: 14px;
            }

            .app-page-body .app-shell,
            .auth-page-body .auth-shell {
                height: auto;
                min-height: auto;
            }

            .app-page-body .dashboard-layout {
                height: auto;
                min-height: auto;
            }

            .app-page-body .dashboard-sidebar,
            .app-page-body .dashboard-main,
            .app-page-body .dashboard-content,
            .auth-page-body .auth-window,
            .auth-page-body .auth-card,
            .auth-page-body .auth-side,
            .auth-page-body .auth-main {
                height: auto;
                min-height: auto;
                overflow: visible;
            }

            .toast-stack {
                top: 12px;
                right: 12px;
                left: 12px;
            }

            .app-toast {
                min-width: 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .page-frame {
                padding: 10px;
            }

            .auth-window,
            .dashboard-main,
            .dashboard-content {
                padding: 12px;
            }

            .auth-card {
                border-radius: 22px;
            }

            .auth-side,
            .auth-main {
                padding: 20px;
            }

            .dashboard-content {
                border-radius: 22px;
            }

            .sidebar-brand {
                padding-left: 4px;
                padding-right: 4px;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="<?php echo e($isGuestPage ? 'auth-page-body' : 'app-page-body'); ?>">
    <?php if(session('success') || session('error')): ?>
        <div class="toast-stack">
            <?php if(session('success')): ?>
                <div class="app-toast app-toast-success auto-dismiss-toast">
                    <div class="app-toast-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="app-toast-body">
                        <div class="app-toast-title">Berhasil</div>
                        <div class="app-toast-text"><?php echo e(session('success')); ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="app-toast app-toast-error auto-dismiss-toast">
                    <div class="app-toast-icon">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                    <div class="app-toast-body">
                        <div class="app-toast-title">Terjadi masalah</div>
                        <div class="app-toast-text"><?php echo e(session('error')); ?></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="page-frame">
        <?php if($isGuestPage): ?>
            <main class="auth-shell">
                <div class="auth-window">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger mb-3">
                            <strong class="d-block mb-2">Periksa kembali input berikut:</strong>
                            <ul class="mb-0 ps-3">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        <?php else: ?>
            <div class="app-shell">
                <div class="dashboard-layout">
                    <aside class="dashboard-sidebar">
                        <div class="sidebar-brand">
                            <span class="sidebar-brand-icon">
                                <i class="bi bi-buildings"></i>
                            </span>
                            <div class="sidebar-brand-text">
                                Pengaduan
                                <small>Sarana Sekolah</small>
                            </div>
                        </div>

                        <nav class="sidebar-menu">
                            <?php if($isSiswa): ?>
                                <a href="<?php echo e(route('siswa.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('siswa.dashboard') ? 'active' : ''); ?>">
                                    <i class="bi bi-grid"></i>
                                    Dashboard
                                </a>

                                <a href="<?php echo e(route('siswa.aspirasi.create')); ?>" class="sidebar-link <?php echo e(request()->routeIs('siswa.aspirasi.create') ? 'active' : ''); ?>">
                                    <i class="bi bi-plus-square"></i>
                                    Input Aspirasi
                                </a>

                                <a href="<?php echo e(route('siswa.aspirasi.index')); ?>#daftar-aspirasi" class="sidebar-link <?php echo e(request()->routeIs('siswa.aspirasi.index') || request()->routeIs('siswa.aspirasi.show') || request()->routeIs('siswa.aspirasi.edit') ? 'active' : ''); ?>">
                                    <i class="bi bi-clock-history"></i>
                                    Riwayat Aspirasi
                                </a>
                            <?php elseif($isAdmin): ?>
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                                    <i class="bi bi-grid"></i>
                                    Dashboard
                                </a>

                                <a href="<?php echo e(route('admin.aspirasi.index')); ?>#daftar-aspirasi-admin" class="sidebar-link <?php echo e(request()->routeIs('admin.aspirasi.index') || request()->routeIs('admin.aspirasi.show') || request()->routeIs('admin.aspirasi.edit') ? 'active' : ''); ?>">
                                    <i class="bi bi-kanban"></i>
                                    Kelola Aspirasi
                                </a>
                            <?php endif; ?>
                        </nav>

                        <div class="sidebar-bottom-card">
                            <div class="fw-bold mb-2">Portal Sekolah</div>
                            <p class="small mb-3 text-white-50">
                                Monitoring aspirasi dan pengelolaan laporan sekarang terasa lebih rapi.
                            </p>

                            <?php if($isSiswa): ?>
                                <a href="<?php echo e(route('siswa.aspirasi.create')); ?>" class="mini-btn">
                                    <i class="bi bi-send"></i>
                                    Buat Aspirasi
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('admin.aspirasi.index')); ?>#daftar-aspirasi-admin" class="mini-btn">
                                    <i class="bi bi-list-check"></i>
                                    Lihat Data
                                </a>
                            <?php endif; ?>
                        </div>
                    </aside>

                    <section class="dashboard-main">
                        <div class="dashboard-content" id="top-dashboard-content">
                            <div class="dashboard-topbar">
                                <div class="topbar-search">
                                    <i class="bi bi-grid-1x2"></i>
                                    <span><?php echo e($topbarLabel); ?></span>
                                </div>

                                <div class="topbar-actions">
                                    <div class="topbar-chip">
                                        <i class="bi bi-calendar3"></i>
                                        <?php echo e(now()->translatedFormat('d M Y')); ?>

                                    </div>

                                    <div class="user-badge">
                                        <div class="user-avatar">
                                            <?php echo e(strtoupper(substr($currentUserName, 0, 1))); ?>

                                        </div>
                                        <div class="user-meta">
                                            <strong><?php echo e($currentUserName); ?></strong>
                                            <span><?php echo e($currentUserSub); ?></span>
                                        </div>
                                    </div>

                                    <?php if($isAdmin): ?>
                                        <form method="post" action="<?php echo e(route('admin.logout')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button class="logout-btn" title="Logout">
                                                <i class="bi bi-box-arrow-right"></i>
                                            </button>
                                        </form>
                                    <?php elseif($isSiswa): ?>
                                        <form method="post" action="<?php echo e(route('siswa.logout')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button class="logout-btn" title="Logout">
                                                <i class="bi bi-box-arrow-right"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger mb-3">
                                    <strong class="d-block mb-2">Periksa kembali input berikut:</strong>
                                    <ul class="mb-0 ps-3">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </section>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.auto-dismiss-toast').forEach(function (toastEl) {
                setTimeout(function () {
                    toastEl.classList.add('hide');

                    setTimeout(function () {
                        toastEl.remove();
                    }, 300);
                }, 1000);
            });

            function scrollDashboardHashTarget() {
                if (!window.location.hash) return;

                const targetId = decodeURIComponent(window.location.hash.substring(1));
                const targetEl = document.getElementById(targetId);
                const scrollContainer = document.querySelector('.dashboard-content');

                if (!targetEl) return;

                if (scrollContainer) {
                    const containerRect = scrollContainer.getBoundingClientRect();
                    const targetRect = targetEl.getBoundingClientRect();
                    const offsetTop = scrollContainer.scrollTop + (targetRect.top - containerRect.top) - 12;

                    scrollContainer.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                } else {
                    targetEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }

            setTimeout(scrollDashboardHashTarget, 100);
            window.addEventListener('hashchange', scrollDashboardHashTarget);
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\user\Downloads\pengaduan-sekolah-laravel\pengaduan-sekolah-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>