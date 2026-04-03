@extends('layouts.app', ['title' => 'Dashboard Admin'])

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1">Dashboard Admin</h1>
        <p class="text-muted mb-0">Kelola aspirasi, feedback, histori, dan progres perbaikan.</p>
    </div>
</div>

<div class="row g-3 mb-4">
    @foreach([
        ['label' => 'Total', 'value' => $ringkasan['total'], 'class' => 'primary'],
        ['label' => 'Menunggu', 'value' => $ringkasan['menunggu'], 'class' => 'secondary'],
        ['label' => 'Proses', 'value' => $ringkasan['proses'], 'class' => 'warning'],
        ['label' => 'Selesai', 'value' => $ringkasan['selesai'], 'class' => 'success'],
    ] as $item)
        <div class="col-6 col-lg-3">
            <div class="card card-shadow h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ $item['label'] }}</div>
                    <div class="display-6 fw-bold text-{{ $item['class'] }}">{{ $item['value'] }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="card card-shadow mb-4">
    <div class="card-body">
        <h2 class="h5 mb-3">Filter Aspirasi</h2>
        <form method="get" class="row g-3">
            <div class="col-md-2">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $filters['tanggal'] ?? '' }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Bulan</label>
                <input type="month" name="bulan" value="{{ $filters['bulan'] ?? '' }}" class="form-control">
            </div>
            <div class="col-md-3">
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
            <div class="col-md-2">
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
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua status</option>
                    @foreach(['Menunggu', 'Proses', 'Selesai'] as $status)
                        <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>
        <div class="mt-3">
            <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-outline-secondary btn-sm">Reset Filter</a>
        </div>
    </div>
</div>

<div class="card card-shadow">
    <div class="card-body">
        <h2 class="h5 mb-3">Daftar Aspirasi</h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
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
                        <td>{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="fw-semibold">{{ $aspirasi->siswa->nama }}</div>
                            <div class="small text-muted">{{ $aspirasi->nis }} - {{ $aspirasi->siswa->kelas }}</div>
                        </td>
                        <td>{{ $aspirasi->kategori->ket_kategori }}</td>
                        <td>{{ $aspirasi->lokasi }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($aspirasi->ket, 70) }}</td>
                        <td>
                            <span class="badge status-badge text-bg-{{ $aspirasi->status === 'Selesai' ? 'success' : ($aspirasi->status === 'Proses' ? 'warning' : 'secondary') }}">
                                {{ $aspirasi->status }}
                            </span>
                        </td>
                        <td style="min-width: 160px;">
                            <div class="progress" role="progressbar" aria-valuenow="{{ $aspirasi->progress_persen }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: {{ $aspirasi->progress_persen }}%">{{ $aspirasi->progress_persen }}%</div>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            <a href="{{ route('admin.aspirasi.edit', $aspirasi) }}" class="btn btn-sm btn-primary">Update</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data aspirasi.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $aspirasis->links() }}
    </div>
</div>
@endsection
