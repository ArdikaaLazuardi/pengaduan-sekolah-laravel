@extends('layouts.app', ['title' => 'Login Siswa'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card card-shadow mt-5">
            <div class="card-body p-4">
                <h1 class="h4 mb-3 text-center">Login Siswa</h1>
                <p class="text-muted text-center">Masuk menggunakan NIS sesuai data sekolah.</p>

                <form method="post" action="{{ route('siswa.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" name="nis" value="{{ old('nis') }}" class="form-control" required autofocus>
                    </div>

                    <button class="btn btn-primary w-100">Login Siswa</button>
                </form>

                <div class="alert alert-warning small mt-3 mb-0">
                    Demo seeder: gunakan NIS <strong>2025001</strong>, <strong>2025002</strong>, atau <strong>2025003</strong>.
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('admin.login') }}" class="small">Login sebagai admin</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
