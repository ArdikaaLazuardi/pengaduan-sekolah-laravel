@extends('layouts.app', ['title' => 'Dashboard Siswa'])

@section('content')
@php
    $items = collect($aspirasis->items());
    $latestAspirasi = $items->first();
    $avgProgress = $items->count() ? round($items->avg('progress_persen')) : 0;
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
@endphp

<div id="top-dashboard-siswa"></div>

<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <div class="small text-uppercase fw-bold" style="letter-spacing:.12em; color: var(--text-soft);">Student Dashboard</div>
        <h1 class="mb-2" style="font-size:2rem; font-weight:800; letter-spacing:-.03em;">Histori Aspirasi Saya</h1>
        <p class="mb-0" style="color: var(--text-soft); max-width: 760px;">
            Pantau status penyelesaian, feedback admin, dan progres perbaikan dengan tampilan yang lebih modern,
            clean, dan nyaman dibaca.
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>
            Input Aspirasi
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
                    <div class="small mt-2" style="color: var(--text-soft);">Seluruh laporan yang pernah kamu kirim</div>
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
                    <div class="small mt-2" style="color: var(--text-soft);">{{ $donePercent }}% sudah diselesaikan</div>
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
                    <div class="small text-white-50 fw-semibold mb-2">Ringkasan Akun Siswa</div>
                    <div style="font-size:2rem; font-weight:800; line-height:1.1;">
                        {{ auth('siswa')->user()->nama }}
                    </div>
                    <div class="mt-2 text-white-50">
                        {{ auth('siswa')->user()->nis }} • {{ auth('siswa')->user()->kelas }}
                    </div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width:54px; height:54px; background: rgba(255,255,255,.12);">
                    <i class="bi bi-person-badge fs-5"></i>
                </div>
            </div>

            <div class="rounded-4 p-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Rata-rata progres laporan pada halaman ini</div>
                <div class="d-flex align-items-center justify-content-between">
                    <div style="font-size:1.8rem; font-weight:800;">{{ $avgProgress }}%</div>
                    <div class="small text-white-50">Update visual modern</div>
                </div>
            </div>

            <div class="mt-4">
                <div class="small text-white-50 mb-2">Aksi cepat</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-send me-1"></i>
                        Kirim Aspirasi
                    </a>
                    <a href="{{ route('siswa.aspirasi.index') }}#daftar-aspirasi" class="btn btn-outline-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-clock-history me-1"></i>
                        Lihat Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card-soft p-4 h-100">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Progress Overview</div>
                    <h5 class="mb-1 fw-bold">Statistik penyelesaian aspirasi</h5>
                    <div class="small" style="color: var(--text-soft);">Ringkasan visual berdasarkan status laporan kamu.</div>
                </div>

                <div class="topbar-chip">
                    <i class="bi bi-bar-chart"></i>
                    Dashboard Siswa
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
                            Laporan yang masih belum diproses admin.
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
                            Laporan yang sedang ditangani atau diperbaiki.
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
                            Laporan yang sudah selesai ditindaklanjuti.
                        </div>
                    </div>
                </div>
            </div>

            @if($latestAspirasi)
                <div class="mt-4 p-3 rounded-4" style="background:#f6f3ee; border:1px solid var(--border-soft);">
                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                        <div>
                            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Aspirasi Terbaru</div>
                            <div class="fw-bold mb-1">{{ $latestAspirasi->kategori->ket_kategori }}</div>
                            <div class="small" style="color: var(--text-soft);">
                                {{ $latestAspirasi->lokasi }} • {{ $latestAspirasi->created_at->format('d M Y') }}
                            </div>
                            <div class="mt-2" style="color:#4b5563;">
                                {{ \Illuminate\Support\Str::limit($latestAspirasi->ket, 120) }}
                            </div>
                        </div>
                        <div class="text-lg-end">
                            <span class="status-pill {{ $statusClass($latestAspirasi->status) }}">
                                {{ $latestAspirasi->status }}
                            </span>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Progress {{ $latestAspirasi->progress_persen }}%
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="card-soft p-0 overflow-hidden" id="daftar-aspirasi">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 p-4 border-bottom" style="border-color: var(--border-soft) !important;">
        <div>
            <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Daftar Aspirasi</div>
            <h5 class="mb-1 fw-bold">Riwayat laporan siswa</h5>
            <div class="small" style="color: var(--text-soft);">
                Semua histori aspirasi yang pernah kamu kirim ditampilkan di bawah ini.
            </div>
        </div>

        <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-soft">
            <i class="bi bi-plus-circle me-2"></i>
            Buat Aspirasi Baru
        </a>
    </div>

    @forelse($aspirasis as $aspirasi)
        <div class="d-block d-xl-none p-3 border-bottom" style="border-color: var(--border-soft) !important;">
            <div class="card-soft p-3 shadow-none border">
                <div class="d-flex justify-content-between gap-3 mb-2">
                    <div>
                        <div class="fw-bold">{{ $aspirasi->kategori->ket_kategori }}</div>
                        <div class="small" style="color: var(--text-soft);">
                            {{ $aspirasi->created_at->format('d/m/Y') }} • {{ $aspirasi->lokasi }}
                        </div>
                    </div>
                    <span class="status-pill {{ $statusClass($aspirasi->status) }}">
                        {{ $aspirasi->status }}
                    </span>
                </div>

                <div class="small mb-2" style="color:#4b5563;">
                    {{ \Illuminate\Support\Str::limit($aspirasi->ket, 100) }}
                </div>

                <div class="small mb-2" style="color: var(--text-soft);">
                    Feedback: {{ \Illuminate\Support\Str::limit($aspirasi->feedback ?: '-', 80) }}
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
                    <a href="{{ route('siswa.aspirasi.show', $aspirasi) }}" class="btn btn-soft btn-sm">
                        <i class="bi bi-eye me-1"></i>
                        Detail
                    </a>

                    @if($aspirasi->status === 'Menunggu')
                        <a href="{{ route('siswa.aspirasi.edit', $aspirasi) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square me-1"></i>
                            Ubah
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
    @endforelse

    <div class="table-responsive d-none d-xl-block">
        <table class="table table-modern align-middle">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Isi Aspirasi</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>Progress</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirasis as $aspirasi)
                    <tr>
                        <td class="fw-semibold">{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $aspirasi->kategori->ket_kategori }}</div>
                        </td>
                        <td>{{ $aspirasi->lokasi }}</td>
                        <td style="min-width: 260px;">{{ \Illuminate\Support\Str::limit($aspirasi->ket, 80) }}</td>
                        <td>
                            <span class="status-pill {{ $statusClass($aspirasi->status) }}">
                                {{ $aspirasi->status }}
                            </span>
                        </td>
                        <td style="min-width: 220px;">{{ \Illuminate\Support\Str::limit($aspirasi->feedback ?: '-', 60) }}</td>
                        <td style="min-width: 150px;">
                            <div class="small fw-bold mb-1">{{ $aspirasi->progress_persen }}%</div>
                            <div class="progress" style="height:8px; border-radius:999px; background:#ece7e1;">
                                <div class="progress-bar" style="width: {{ $aspirasi->progress_persen }}%; background: var(--primary);"></div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('siswa.aspirasi.show', $aspirasi) }}" class="btn btn-soft btn-sm">
                                    Detail
                                </a>

                                @if($aspirasi->status === 'Menunggu')
                                    <a href="{{ route('siswa.aspirasi.edit', $aspirasi) }}" class="btn btn-primary btn-sm">
                                        Ubah
                                    </a>
                                @endif
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
                                <h6 class="fw-bold mb-2">Belum ada aspirasi yang dikirim</h6>
                                <p class="mb-3" style="color: var(--text-soft);">
                                    Mulai kirim laporan pertama kamu untuk sarana sekolah yang perlu diperbaiki.
                                </p>
                                <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Input Aspirasi
                                </a>
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
                <h6 class="fw-bold mb-2">Belum ada aspirasi yang dikirim</h6>
                <p class="mb-3" style="color: var(--text-soft);">
                    Mulai kirim laporan pertama kamu untuk sarana sekolah yang perlu diperbaiki.
                </p>
                <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Input Aspirasi
                </a>
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