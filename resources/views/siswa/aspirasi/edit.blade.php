@extends('layouts.app', ['title' => 'Ubah Aspirasi'])

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
        <div class="small text-uppercase fw-bold" style="letter-spacing:.12em; color: var(--text-soft);">Student Edit Form</div>
        <h1 class="mb-2" style="font-size:2rem; font-weight:800; letter-spacing:-.03em;">Ubah Aspirasi</h1>
        <p class="mb-0" style="color: var(--text-soft); max-width: 760px;">
            Perbarui isi laporan selama status aspirasi masih <strong>Menunggu</strong>.
            Tampilan form dibuat lebih modern, rapi, dan konsisten dengan dashboard siswa.
        </p>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('siswa.aspirasi.show', $aspirasi) }}" class="btn btn-soft">
            <i class="bi bi-eye me-2"></i>
            Lihat Detail
        </a>
        <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-soft">
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
                    <div class="small text-white-50 fw-semibold mb-2">Edit Aspirasi</div>
                    <div style="font-size:1.85rem; font-weight:800; line-height:1.15;">
                        Perbarui laporan dengan informasi yang lebih jelas.
                    </div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                     style="width:54px; height:54px; background: rgba(255,255,255,.12);">
                    <i class="bi bi-pencil-square fs-5"></i>
                </div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Status Saat Ini</div>
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <div class="fw-semibold">{{ $aspirasi->status }}</div>
                    <span class="badge rounded-pill text-bg-light px-3 py-2">{{ $aspirasi->progress_persen }}%</span>
                </div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Kategori Sekarang</div>
                <div class="fw-semibold">{{ $aspirasi->kategori->ket_kategori }}</div>
            </div>

            <div class="rounded-4 p-3 mb-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Lokasi</div>
                <div class="fw-semibold">{{ $aspirasi->lokasi }}</div>
            </div>

            <div class="rounded-4 p-3" style="background: rgba(255,255,255,.09); border:1px solid rgba(255,255,255,.10);">
                <div class="small text-white-50 mb-1">Catatan</div>
                <div class="fw-semibold" style="line-height:1.7;">
                    Aspirasi hanya dapat diubah selama status masih <strong>Menunggu</strong>.
                </div>
            </div>

            <div class="mt-4">
                <div class="small text-white-50 mb-2">Akses cepat</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('siswa.aspirasi.show', $aspirasi) }}" class="btn btn-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-file-earmark-text me-1"></i>
                        Detail
                    </a>
                    <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-light btn-sm px-3 rounded-pill fw-bold">
                        <i class="bi bi-clock-history me-1"></i>
                        Riwayat
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
                        <div class="small fw-bold text-uppercase mb-2" style="letter-spacing:.08em; color: var(--text-soft);">Form Perubahan</div>
                        <h5 class="mb-1 fw-bold">Perbarui data laporan</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Edit data aspirasi dengan informasi yang lebih tepat agar mudah diproses.
                        </div>
                    </div>

                    <span class="status-pill {{ $statusClass }}">
                        {{ $aspirasi->status }}
                    </span>
                </div>
            </div>

            <div class="p-4 p-lg-5">
                <form method="post" action="{{ route('siswa.aspirasi.update', $aspirasi) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-tags"></i>
                                </span>
                                <select name="kategori_id" class="form-select" required>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" @selected(old('kategori_id', $aspirasi->kategori_id) == $kategori->id)>
                                            {{ $kategori->ket_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Pilih kategori yang paling sesuai dengan laporan kamu.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Lokasi</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                                <input
                                    type="text"
                                    name="lokasi"
                                    value="{{ old('lokasi', $aspirasi->lokasi) }}"
                                    class="form-control"
                                    maxlength="100"
                                    placeholder="Contoh: Lab Komputer / Kelas XI IPA 1 / Toilet Timur"
                                    required
                                >
                            </div>
                            <div class="small mt-2" style="color: var(--text-soft);">
                                Gunakan lokasi yang spesifik agar laporan lebih mudah ditindaklanjuti.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Isi Aspirasi</label>
                            <div class="p-3 rounded-4" style="background:#f8f6f2; border:1px solid var(--border-soft);">
                                <textarea
                                    name="ket"
                                    rows="7"
                                    class="form-control"
                                    maxlength="2000"
                                    placeholder="Perbarui isi laporan di sini..."
                                    style="min-height: 180px; resize: vertical;"
                                    required
                                >{{ old('ket', $aspirasi->ket) }}</textarea>

                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="small" style="color: var(--text-soft);">
                                        Pastikan deskripsi jelas, singkat, dan mudah dipahami.
                                    </div>
                                    <div class="small" style="color: var(--text-soft);">
                                        Maks. 2000 karakter
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4 pt-2">
                        <div class="small" style="color: var(--text-soft); max-width: 520px;">
                            Setelah disimpan, perubahan akan langsung memperbarui data aspirasi kamu di dashboard siswa.
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('siswa.aspirasi.show', $aspirasi) }}" class="btn btn-soft">
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
                        <h5 class="mb-1 fw-bold">Hapus aspirasi</h5>
                        <div class="small" style="color: var(--text-soft);">
                            Gunakan hanya jika kamu memang ingin menghapus laporan ini dari sistem.
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
                                Data aspirasi yang dihapus tidak akan muncul lagi di dashboard siswa.
                            </div>
                        </div>

                        <form method="post"
                              action="{{ route('siswa.aspirasi.destroy', $aspirasi) }}"
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