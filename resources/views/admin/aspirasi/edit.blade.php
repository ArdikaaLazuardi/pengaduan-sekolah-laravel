@extends('layouts.app', ['title' => 'Update Aspirasi'])

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Update Status Aspirasi</h1>
                <p class="text-muted mb-0">{{ $aspirasi->siswa->nama }} · {{ $aspirasi->kategori->ket_kategori }} · {{ $aspirasi->lokasi }}</p>
            </div>
            <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" class="btn btn-outline-secondary">Kembali</a>
        </div>

        <div class="card card-shadow">
            <div class="card-body">
                <div class="alert alert-light border">
                    <div class="fw-semibold mb-1">Isi aspirasi</div>
                    {{ $aspirasi->ket }}
                </div>

                <form method="post" action="{{ route('admin.aspirasi.update', $aspirasi) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                @foreach(['Menunggu', 'Proses', 'Selesai'] as $status)
                                    <option value="{{ $status }}" @selected(old('status', $aspirasi->status) === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Progress (%)</label>
                            <input type="number" name="progress_persen" min="0" max="100" class="form-control"
                                   value="{{ old('progress_persen', $aspirasi->progress_persen) }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Feedback untuk siswa</label>
                            <textarea name="feedback" rows="4" class="form-control">{{ old('feedback', $aspirasi->feedback) }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan progres baru</label>
                            <textarea name="catatan_progress" rows="4" class="form-control" placeholder="Contoh: Teknisi mengganti lampu dan memeriksa instalasi listrik.">{{ old('catatan_progress') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

                <hr class="my-4">

                <form method="post" action="{{ route('admin.aspirasi.destroy', $aspirasi) }}" onsubmit="return confirm('Hapus aspirasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Hapus Aspirasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
