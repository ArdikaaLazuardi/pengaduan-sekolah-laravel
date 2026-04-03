<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Pengaduan Sarana Sekolah' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fb; }
        .navbar-brand { font-weight: 700; }
        .card-shadow { box-shadow: 0 0.5rem 1.25rem rgba(15, 23, 42, .08); border: 0; }
        .status-badge { min-width: 96px; }
        .timeline { border-left: 3px solid #0d6efd; margin-left: .5rem; padding-left: 1rem; }
        .timeline-item { position: relative; margin-bottom: 1rem; }
        .timeline-item::before {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #0d6efd;
            left: -1.45rem;
            top: .35rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route(auth('admin')->check() ? 'admin.dashboard' : 'siswa.dashboard') }}">
            Pengaduan Sarana Sekolah
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto">
                @if(auth('admin')->check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.aspirasi.index') }}">Dashboard Admin</a></li>
                @elseif(auth('siswa')->check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('siswa.aspirasi.index') }}">Histori Aspirasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('siswa.aspirasi.create') }}">Input Aspirasi</a></li>
                @endif
            </ul>

            <div class="d-flex align-items-center gap-2 text-white">
                @if(auth('admin')->check())
                    <span class="small">Admin: {{ auth('admin')->user()->username }}</span>
                    <form method="post" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @elseif(auth('siswa')->check())
                    <span class="small">{{ auth('siswa')->user()->nama }} ({{ auth('siswa')->user()->nis }})</span>
                    <form method="post" action="{{ route('siswa.logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-2">Periksa kembali input berikut:</div>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ $slot ?? '' }}
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
