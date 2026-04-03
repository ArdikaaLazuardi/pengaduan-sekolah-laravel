@extends('layouts.app', ['title' => 'Input Aspirasi'])

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Form Aspirasi Siswa</h1>
                <p class="text-muted mb-0">Sampaikan keluhan atau masukan terkait sarana dan prasarana sekolah.</p>
            </div>
            <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>

        <div class="card card-shadow">
            <div class="card-body">
                <form method="post" action="{{ route('siswa.aspirasi.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">Pilih kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>{{ $kategori->ket_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Aspirasi / Pengaduan</label>
                        <textarea name="ket" rows="6" class="form-control" maxlength="2000" required>{{ old('ket') }}</textarea>
                    </div>

                    <button class="btn btn-primary">Kirim Aspirasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
