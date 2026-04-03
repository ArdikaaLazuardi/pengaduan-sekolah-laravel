@extends('layouts.app', ['title' => 'Detail Aspirasi Saya'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Detail Aspirasi</h1>
        <p class="text-muted mb-0">Pantau umpan balik admin dan progres perbaikan sarana.</p>
    </div>
    <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card card-shadow">
            <div class="card-body">
                <h2 class="h5 mb-3">Informasi Aspirasi</h2>
                <dl class="row mb-0">
                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8">{{ $aspirasi->created_at->format('d F Y H:i') }}</dd>

                    <dt class="col-sm-4">Kategori</dt>
                    <dd class="col-sm-8">{{ $aspirasi->kategori->ket_kategori }}</dd>

                    <dt class="col-sm-4">Lokasi</dt>
                    <dd class="col-sm-8">{{ $aspirasi->lokasi }}</dd>

                    <dt class="col-sm-4">Keluhan</dt>
                    <dd class="col-sm-8">{{ $aspirasi->ket }}</dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">{{ $aspirasi->status }}</dd>

                    <dt class="col-sm-4">Feedback Admin</dt>
                    <dd class="col-sm-8">{{ $aspirasi->feedback ?: 'Belum ada feedback.' }}</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card card-shadow mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3">Progres Perbaikan</h2>
                <div class="progress mb-3" role="progressbar" aria-valuenow="{{ $aspirasi->progress_persen }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: {{ $aspirasi->progress_persen }}%">{{ $aspirasi->progress_persen }}%</div>
                </div>
                <p class="mb-0 text-muted">Status saat ini: {{ $aspirasi->status }}</p>
            </div>
        </div>

        <div class="card card-shadow">
            <div class="card-body">
                <h2 class="h5 mb-3">Histori Progres</h2>
                <div class="timeline">
                    @forelse($aspirasi->progressUpdates as $progress)
                        <div class="timeline-item">
                            <div class="fw-semibold">{{ $progress->progress_persen }}%</div>
                            <div>{{ $progress->catatan }}</div>
                            <div class="small text-muted">{{ $progress->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    @empty
                        <div class="text-muted">Belum ada progres perbaikan yang dicatat.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
