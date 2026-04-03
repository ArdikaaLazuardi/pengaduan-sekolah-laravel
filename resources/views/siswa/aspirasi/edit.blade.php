@extends('layouts.app', ['title' => 'Ubah Aspirasi'])

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Ubah Aspirasi</h1>
                <p class="text-muted mb-0">Aspirasi hanya dapat diubah selama status masih Menunggu.</p>
            </div>
            <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>

        <div class="card card-shadow">
            <div class="card-body">
                <form method="post" action="{{ route('siswa.aspirasi.update', $aspirasi) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(old('kategori_id', $aspirasi->kategori_id) == $kategori->id)>{{ $kategori->ket_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $aspirasi->lokasi) }}" class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Aspirasi</label>
                        <textarea name="ket" rows="6" class="form-control" maxlength="2000" required>{{ old('ket', $aspirasi->ket) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

                <hr class="my-4">

                <form method="post" action="{{ route('siswa.aspirasi.destroy', $aspirasi) }}" onsubmit="return confirm('Hapus aspirasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Hapus Aspirasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
