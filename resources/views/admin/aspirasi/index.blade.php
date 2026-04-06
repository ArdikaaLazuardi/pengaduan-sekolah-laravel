@extends('layouts.app', ['title' => 'Dashboard Admin'])

@section('content')
@php
    $donePercent = $ringkasan['total'] > 0 ? round(($ringkasan['selesai'] / $ringkasan['total']) * 100) : 0;
    $processPercent = $ringkasan['total'] > 0 ? round(($ringkasan['proses'] / $ringkasan['total']) * 100) : 0;
    $waitingPercent = $ringkasan['total'] > 0 ? round(($ringkasan['menunggu'] / $ringkasan['total']) * 100) : 0;

    $statusClass = function ($status) {
        return match ($status) {
            'Menunggu' => 'status-menunggu',
            'Proses' => 'status-proses',
            'Selesai' => 'status-selesai',
            default => 'status-menunggu',
        };
    };

    $activeFilterCount = collect($filters ?? [])->filter(fn ($value) => filled($value))->count();
    $latestAspirasi = collect($aspirasis->items())->first();
@endphp

<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <div class="small text-uppercase fw-bold" style="letter-spacing:.12em; color: var(--text-soft);">Admin Dashboard</div>
        <h1 class="mb-2" style="font-size:2rem; font-weight:800; letter-spacing:-.03em;">Kelola Aspirasi Siswa</h1>
        <p class="mb-0" style="color: var(--text-soft); max-width: 760px;">
            Pantau laporan yang masuk, lihat progres penanganan, dan kelola tindak lanjut
            dengan tampilan yang lebih modern, clean, dan mendekati konsep dashboard referensi kamu.
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-soft">
            <i class="bi bi-arrow-clockwise me-2"></i>
            Refresh Data
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-soft p-4 h-100">
            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Total Aspirasi</div>
            <div class="d-flex align-items-end justify-content-between">
                <div>
                    <div style="font-size:2rem; font-weight:800; line-height:1;">{{ $ringkasan['total'] }}</div>
                    <div class="small mt-2" style="color: var(--text-soft);">Semua laporan yang tercatat</div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width:54px; height:54px; background:#eef3f1; color:var(--primary);">
                    <i class="bi bi-stack"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-soft p-4 h-100">
            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Menunggu</div>
            <div class="d-flex align-items-end justify-content-between">
                <div>
                    <div style="font-size:2rem; font-weight:800; line-height:1;">{{ $ringkasan['menunggu'] }}</div>
                    <div class="small mt-2" style="color: var(--text-soft);">{{ $waitingPercent }}% dari total laporan</div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width:54px; height:54px; background:#f1efea; color:#6b7280;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-soft p-4 h-100">
            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Dalam Proses</div>
            <div class="d-flex align-items-end justify-content-between">
                <div>
                    <div style="font-size:2rem; font-weight:800; line-height:1;">{{ $ringkasan['proses'] }}</div>
                    <div class="small mt-2" style="color: var(--text-soft);">{{ $processPercent }}% sedang ditangani</div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width:54px; height:54px; background:#fff5dc; color:#a16207;">
                    <i class="bi bi-gear-wide-connected"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card-soft p-4 h-100">
            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Selesai</div>
            <div class="d-flex align-items-end justify-content-between">
                <div>
                    <div style="font-size:2rem; font-weight:800; line-height:1;">{{ $ringkasan['selesai'] }}</div>
                    <div class="small mt-2" style="color: var(--text-soft);">{{ $donePercent }}% sudah tuntas</div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width:54px; height:54px; background:#dcfce7; color:#166534;">
                    <i class="bi bi-check2-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-xl-4">
        <div class="card-soft p-4 h-100" style="background: linear-gradient(145deg, #0f4f4b 0%, #0b3d3a 100%); color: #fff;">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <div class="small text-white-50 fw-semibold mb-2">Admin Overview</div>
                    <div style="font-size:2rem; font-weight:800; line-height:1.1;">
                        {{ auth('admin')->user()->username }}
                    </div>
                    <div class="mt-2 text-white-50">
                        Administrator • Panel Pengelolaan
                    </div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width:54px; height:54px; background: rgba(255,255,255,.12);">
                    <i class="bi bi-shield-check fs-5"></i>
                </div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Filter aktif</div>
                <div class="d-flex align-items-center justify-content-between">
                    <div style="font-size:1.8rem; font-weight:800;">{{ $activeFilterCount }}</div>
                    <div class="small text-white-50">parameter terpakai</div>
                </div>
            </div>

            @if($latestAspirasi)
                <div class="rounded-4 p-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                    <div class="small text-white-50 mb-1">Data terbaru di halaman ini</div>
                    <div class="fw-bold">{{ $latestAspirasi->siswa->nama }}</div>
                    <div class="small text-white-50 mt-1">
                        {{ $latestAspirasi->kategori->ket_kategori }} • {{ $latestAspirasi->lokasi }}
                    </div>
                    <div class="small mt-2">
                        Progress {{ $latestAspirasi->progress_persen }}%
                    </div>
                </div>
            @endif

            <div class="mt-4">
                <div class="small text-white-50 mb-2">Aksi cepat</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-funnel me-1"></i>
                        Filter Data
                    </a>
                    <a href="{{ route('admin.aspirasi.index') }}#daftar-aspirasi-admin" class="btn btn-outline-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-table me-1"></i>
                        Lihat Tabel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card-soft p-4 h-100">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Workload Overview</div>
                    <h5 class="mb-1 fw-bold">Distribusi penanganan aspirasi</h5>
                    <div class="small" style="color: var(--text-soft);">Visual sederhana untuk melihat beban kerja laporan saat ini.</div>
                </div>

                <div class="topbar-chip">
                    <i class="bi bi-bar-chart"></i>
                    Monitoring Admin
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 h-100" style="background:#f6f3ee; border:1px solid var(--border-soft);">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fw-bold">Menunggu</div>
                            <div class="small text-muted">{{ $waitingPercent }}%</div>
                        </div>
                        <div class="progress" style="height:10px; border-radius:999px; background:#e8e2da;">
                            <div class="progress-bar" style="width: {{ $waitingPercent }}%; background:#9ca3af;"></div>
                        </div>
                        <div class="small mt-3" style="color: var(--text-soft);">
                            Laporan yang belum diproses.
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded-4 h-100" style="background:#fff8e8; border:1px solid #f3e4b0;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fw-bold">Proses</div>
                            <div class="small text-muted">{{ $processPercent }}%</div>
                        </div>
                        <div class="progress" style="height:10px; border-radius:999px; background:#f6e9c8;">
                            <div class="progress-bar" style="width: {{ $processPercent }}%; background:#d4a017;"></div>
                        </div>
                        <div class="small mt-3" style="color: var(--text-soft);">
                            Laporan yang sedang ditindaklanjuti.
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded-4 h-100" style="background:#ecfdf3; border:1px solid #cdeed8;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fw-bold">Selesai</div>
                            <div class="small text-muted">{{ $donePercent }}%</div>
                        </div>
                        <div class="progress" style="height:10px; border-radius:999px; background:#dff5e8;">
                            <div class="progress-bar" style="width: {{ $donePercent }}%; background:#1f9254;"></div>
                        </div>
                        <div class="small mt-3" style="color: var(--text-soft);">
                            Laporan yang sudah selesai ditangani.
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-4" style="background:#f6f3ee; border:1px solid var(--border-soft);">
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                    <div>
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Info Filter</div>
                        <div class="fw-bold mb-1">Pencarian data aspirasi</div>
                        <div class="small" style="color: var(--text-soft);">
                            Gunakan filter tanggal, bulan, siswa, kategori, dan status untuk mempermudah monitoring.
                        </div>
                    </div>
                    <div class="text-lg-end">
                        <div class="small" style="color: var(--text-soft);">Filter aktif</div>
                        <div style="font-size:1.6rem; font-weight:800; line-height:1;">{{ $activeFilterCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-soft p-4 mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Filter Aspirasi</div>
            <h5 class="mb-1 fw-bold">Cari laporan dengan cepat</h5>
            <div class="small" style="color: var(--text-soft);">
                Tampilkan data berdasarkan waktu, siswa, kategori, dan status.
            </div>
        </div>

        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-soft">
            <i class="bi bi-arrow-counterclockwise me-2"></i>
            Reset Filter
        </a>
    </div>

    <form method="get" class="row g-3">
        <div class="col-md-6 col-xl-2">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $filters['tanggal'] ?? '' }}" class="form-control">
        </div>

        <div class="col-md-6 col-xl-2">
            <label class="form-label">Bulan</label>
            <input type="month" name="bulan" value="{{ $filters['bulan'] ?? '' }}" class="form-control">
        </div>

        <div class="col-md-6 col-xl-3">
            <label class="form-label">Siswa</label>
            <select name="siswa" class="form-select">
                <option value="">Semua siswa</option>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->nis }}" @selected(($filters['siswa'] ?? '') === $siswa->nis)>
                        {{ $siswa->nis }} - {{ $siswa->nama }} ({{ $siswa->kelas }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 col-xl-2">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-select">
                <option value="">Semua kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected((string) ($filters['kategori'] ?? '') === (string) $kategori->id)>
                        {{ $kategori->ket_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 col-xl-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="">Semua status</option>
                @foreach(['Menunggu', 'Proses', 'Selesai'] as $status)
                    <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 col-xl-1 d-grid">
            <label class="form-label d-none d-xl-block">&nbsp;</label>
            <button class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
</div>

<div class="card-soft p-0 overflow-hidden" id="daftar-aspirasi-admin">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 p-4 border-bottom" style="border-color: var(--border-soft) !important;">
        <div>
            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Daftar Aspirasi</div>
            <h5 class="mb-1 fw-bold">Pengelolaan laporan siswa</h5>
            <div class="small" style="color: var(--text-soft);">
                Lihat detail laporan dan lanjutkan ke halaman update untuk proses tindak lanjut.
            </div>
        </div>

        <div class="topbar-chip">
            <i class="bi bi-table"></i>
            {{ $aspirasis->total() }} data
        </div>
    </div>

    @forelse($aspirasis as $aspirasi)
        <div class="d-block d-xl-none p-3 border-bottom" style="border-color: var(--border-soft) !important;">
            <div class="card-soft p-3 shadow-none border">
                <div class="d-flex justify-content-between gap-3 mb-2">
                    <div>
                        <div class="fw-bold">{{ $aspirasi->siswa->nama }}</div>
                        <div class="small" style="color: var(--text-soft);">
                            {{ $aspirasi->nis }} • {{ $aspirasi->siswa->kelas }}
                        </div>
                    </div>
                    <span class="status-pill {{ $statusClass($aspirasi->status) }}">
                        {{ $aspirasi->status }}
                    </span>
                </div>

                <div class="small mb-2" style="color:#4b5563;">
                    <strong>{{ $aspirasi->kategori->ket_kategori }}</strong> • {{ $aspirasi->lokasi }}
                </div>

                <div class="small mb-2" style="color:#4b5563;">
                    {{ \Illuminate\Support\Str::limit($aspirasi->ket, 110) }}
                </div>

                <div class="small mb-2" style="color: var(--text-soft);">
                    Tanggal: {{ $aspirasi->created_at->format('d/m/Y') }}
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span style="color: var(--text-soft);">Progress</span>
                        <span class="fw-bold">{{ $aspirasi->progress_persen }}%</span>
                    </div>
                    <div class="progress" style="height:8px; border-radius:999px; background:#ece7e1;">
                        <div class="progress-bar" style="width: {{ $aspirasi->progress_persen }}%; background: var(--primary);"></div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" class="btn btn-soft btn-sm">
                        <i class="bi bi-eye me-1"></i>
                        Detail
                    </a>

                    <a href="{{ route('admin.aspirasi.edit', $aspirasi) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil-square me-1"></i>
                        Update
                    </a>
                </div>
            </div>
        </div>
    @empty
    @endforelse

    <div class="table-responsive d-none d-xl-block">
        <table class="table table-modern align-middle mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Siswa</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Isi Aspirasi</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirasis as $aspirasi)
                    <tr>
                        <td class="fw-semibold">{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                        <td style="min-width: 220px;">
                            <div class="fw-bold">{{ $aspirasi->siswa->nama }}</div>
                            <div class="small" style="color: var(--text-soft);">
                                {{ $aspirasi->nis }} - {{ $aspirasi->siswa->kelas }}
                            </div>
                        </td>
                        <td>{{ $aspirasi->kategori->ket_kategori }}</td>
                        <td>{{ $aspirasi->lokasi }}</td>
                        <td style="min-width: 280px;">{{ \Illuminate\Support\Str::limit($aspirasi->ket, 80) }}</td>
                        <td>
                            <span class="status-pill {{ $statusClass($aspirasi->status) }}">
                                {{ $aspirasi->status }}
                            </span>
                        </td>
                        <td style="min-width: 160px;">
                            <div class="small fw-bold mb-1">{{ $aspirasi->progress_persen }}%</div>
                            <div class="progress" style="height:8px; border-radius:999px; background:#ece7e1;">
                                <div class="progress-bar" style="width: {{ $aspirasi->progress_persen }}%; background: var(--primary);"></div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" class="btn btn-soft btn-sm">
                                    Detail
                                </a>
                                <a href="{{ route('admin.aspirasi.edit', $aspirasi) }}" class="btn btn-primary btn-sm">
                                    Update
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="mx-auto" style="max-width: 420px;">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:72px; height:72px; background:#f1efea; color:var(--primary);">
                                    <i class="bi bi-inbox fs-3"></i>
                                </div>
                                <h6 class="fw-bold mb-2">Belum ada data aspirasi</h6>
                                <p class="mb-0" style="color: var(--text-soft);">
                                    Data laporan siswa akan muncul di sini setelah ada aspirasi yang masuk.
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($aspirasis->isEmpty())
        <div class="d-xl-none p-4">
            <div class="text-center py-4">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:72px; height:72px; background:#f1efea; color:var(--primary);">
                    <i class="bi bi-inbox fs-3"></i>
                </div>
                <h6 class="fw-bold mb-2">Belum ada data aspirasi</h6>
                <p class="mb-0" style="color: var(--text-soft);">
                    Data laporan siswa akan muncul di sini setelah ada aspirasi yang masuk.
                </p>
            </div>
        </div>
    @endif

    @if($aspirasis->hasPages())
        <div class="p-4 border-top" style="border-color: var(--border-soft) !important;">
            {{ $aspirasis->links() }}
        </div>
    @endif
</div>
@endsection