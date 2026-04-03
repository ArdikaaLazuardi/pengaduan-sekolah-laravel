@extends('layouts.app', ['title' => 'Histori Aspirasi Siswa'])

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1">Histori Aspirasi Saya</h1>
        <p class="text-muted mb-0">Pantau status penyelesaian, feedback admin, dan progres perbaikan.</p>
    </div>
    <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary">+ Input Aspirasi</a>
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

<div class="card card-shadow">
    <div class="card-body">
        <h2 class="h5 mb-3">Daftar Aspirasi</h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Isi Aspirasi</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>Progres</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($aspirasis as $aspirasi)
                    <tr>
                        <td>{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                        <td>{{ $aspirasi->kategori->ket_kategori }}</td>
                        <td>{{ $aspirasi->lokasi }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($aspirasi->ket, 70) }}</td>
                        <td>
                            <span class="badge status-badge text-bg-{{ $aspirasi->status === 'Selesai' ? 'success' : ($aspirasi->status === 'Proses' ? 'warning' : 'secondary') }}">
                                {{ $aspirasi->status }}
                            </span>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($aspirasi->feedback ?: '-', 50) }}</td>
                        <td style="min-width: 160px;">
                            <div class="progress" role="progressbar" aria-valuenow="{{ $aspirasi->progress_persen }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: {{ $aspirasi->progress_persen }}%">{{ $aspirasi->progress_persen }}%</div>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('siswa.aspirasi.show', $aspirasi) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            @if($aspirasi->status === 'Menunggu')
                                <a href="{{ route('siswa.aspirasi.edit', $aspirasi) }}" class="btn btn-sm btn-primary">Ubah</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada aspirasi yang dikirim.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $aspirasis->links() }}
    </div>
</div>
@endsection
