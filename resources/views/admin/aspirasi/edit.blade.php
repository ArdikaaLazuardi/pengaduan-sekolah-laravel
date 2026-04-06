@extends('layouts.app', ['title' => 'Update Aspirasi'])

@section('content')
@php
    $statusClass = match ($aspirasi->status) {
        'Menunggu' => 'status-menunggu',
        'Proses' => 'status-proses',
        'Selesai' => 'status-selesai',
        default => 'status-menunggu',
    };
@endphp

<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <div class="small text-uppercase fw-bold" style="letter-spacing:.12em; color: var(--text-soft);">Admin Update Form</div>
        <h1 class="mb-2" style="font-size:2rem; font-weight:800; letter-spacing:-.03em;">Update Status Aspirasi</h1>
        <p class="mb-0" style="color: var(--text-soft); max-width: 760px;">
            Kelola status laporan siswa, atur progres penanganan, dan tambahkan feedback
            dalam tampilan admin yang lebih modern, rapi, dan nyaman digunakan.
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" class="btn btn-soft">
            <i class="bi bi-eye me-2"></i>
            Lihat Detail
        </a>
        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-soft">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-xl-4">
        <div class="card-soft p-4 h-100" style="background: linear-gradient(145deg, #0f4f4b 0%, #0b3d3a 100%); color: #fff;">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <div class="small text-white-50 fw-semibold mb-2">Laporan Siswa</div>
                    <div style="font-size:1.75rem; font-weight:800; line-height:1.15;">
                        {{ $aspirasi->siswa->nama }}
                    </div>
                    <div class="mt-2 text-white-50">
                        {{ $aspirasi->nis }} • {{ $aspirasi->siswa->kelas }}
                    </div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                     style="width:54px; height:54px; background: rgba(255,255,255,.12);">
                    <i class="bi bi-person-check fs-5"></i>
                </div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Kategori</div>
                <div class="fw-semibold">{{ $aspirasi->kategori->ket_kategori }}</div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Lokasi</div>
                <div class="fw-semibold">{{ $aspirasi->lokasi }}</div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Status Saat Ini</div>
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <div class="fw-semibold">{{ $aspirasi->status }}</div>
                    <span class="badge rounded-pill text-bg-light px-3 py-2">{{ $aspirasi->progress_persen }}%</span>
                </div>
            </div>

            <div class="rounded-4 p-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Isi Aspirasi</div>
                <div class="fw-semibold" style="line-height:1.75;">
                    {{ \Illuminate\Support\Str::limit($aspirasi->ket, 180) }}
                </div>
            </div>

            <div class="mt-4">
                <div class="small text-white-50 mb-2">Akses cepat</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" class="btn btn-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-file-earmark-text me-1"></i>
                        Detail
                    </a>
                    <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-outline-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-table me-1"></i>
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card-soft p-0 overflow-hidden">
            <div class="p-4 border-bottom" style="border-color: var(--border-soft) !important;">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Form Update</div>
                        <h5 class="mb-1 fw-bold">Perbarui status dan progres laporan</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Gunakan form ini untuk mengubah status, memberi feedback, dan mencatat perkembangan terbaru.
                        </div>
                    </div>

                    <span class="status-pill {{ $statusClass }}">
                        {{ $aspirasi->status }}
                    </span>
                </div>
            </div>

            <div class="p-4 p-lg-5">
                <form method="post" action="{{ route('admin.aspirasi.update', $aspirasi) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-ui-checks-grid"></i>
                                </span>
                                <select name="status" class="form-select" required>
                                    @foreach(['Menunggu', 'Proses', 'Selesai'] as $status)
                                        <option value="{{ $status }}" @selected(old('status', $aspirasi->status) === $status)>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Pilih status terbaru sesuai kondisi penanganan saat ini.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Progress (%)</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-speedometer2"></i>
                                </span>
                                <input
                                    type="number"
                                    name="progress_persen"
                                    min="0"
                                    max="100"
                                    class="form-control"
                                    value="{{ old('progress_persen', $aspirasi->progress_persen) }}"
                                    placeholder="0 - 100"
                                    required
                                >
                            </div>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Isi persentase progres penanganan dari 0 sampai 100.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Feedback untuk Siswa</label>
                            <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                                <textarea
                                    name="feedback"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Tulis feedback yang akan dilihat siswa..."
                                    style="min-height: 150px; resize: vertical;"
                                >{{ old('feedback', $aspirasi->feedback) }}</textarea>

                                <div class="small mt-2" style="color: var(--text-soft);">
                                    Feedback ini akan tampil pada detail aspirasi siswa.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan Progres Baru</label>
                            <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                                <textarea
                                    name="catatan_progress"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Contoh: Teknisi mengganti lampu dan memeriksa instalasi listrik."
                                    style="min-height: 150px; resize: vertical;"
                                >{{ old('catatan_progress') }}</textarea>

                                <div class="small mt-2" style="color: var(--text-soft);">
                                    Catatan ini akan masuk ke histori progres penanganan.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4 pt-2">
                        <div class="small" style="color: var(--text-soft); max-width: 520px;">
                            Setelah disimpan, status dan progres aspirasi akan langsung diperbarui di dashboard admin dan detail siswa.
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.aspirasi.show', $aspirasi) }}" class="btn btn-soft">
                                Batal
                            </a>
                            <button class="btn btn-primary">
                                <i class="bi bi-check2-circle me-2"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-soft p-0 overflow-hidden mt-3">
            <div class="p-4 border-bottom" style="border-color: var(--border-soft) !important;">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Zona Hapus</div>
                        <h5 class="mb-1 fw-bold">Hapus data aspirasi</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Gunakan tindakan ini hanya jika data memang perlu dihapus dari sistem.
                        </div>
                    </div>

                    <div class="topbar-chip">
                        <i class="bi bi-trash"></i>
                        Tindakan Permanen
                    </div>
                </div>
            </div>

            <div class="p-4 p-lg-5">
                <div class="p-4 rounded-4" style="background:#fff4f4; border:1px solid #f3d7d7;">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                        <div>
                            <div class="fw-bold mb-1" style="color:#991b1b;">Hapus aspirasi ini</div>
                            <div class="small" style="color:#7f1d1d; line-height:1.7;">
                                Data aspirasi yang dihapus tidak akan muncul lagi di daftar admin maupun dashboard siswa.
                            </div>
                        </div>

                        <form method="post"
                              action="{{ route('admin.aspirasi.destroy', $aspirasi) }}"
                              onsubmit="return confirm('Hapus aspirasi ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger rounded-4 px-4">
                                <i class="bi bi-trash3 me-2"></i>
                                Hapus Aspirasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection