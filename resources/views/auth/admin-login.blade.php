@extends('layouts.app', ['title' => 'Login Admin'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card card-shadow mt-5">
            <div class="card-body p-4">
                <h1 class="h4 mb-3 text-center">Login Admin</h1>
                <p class="text-muted text-center">Masuk menggunakan username dan password.</p>

                <form method="post" action="{{ route('admin.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">Login Admin</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('siswa.login') }}" class="small">Login sebagai siswa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
