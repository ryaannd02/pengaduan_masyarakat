@extends('layouts.app')

@vite('resources/css/registrasi.css')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-sm" style="width:100%;max-width:480px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-1">Registrasi Masyarakat</h4>
            <p class="text-center text-muted mb-4">Buat akun untuk mengirim pengaduan & memantau prosesnya</p>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('masyarakat.register.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" id="nik" name="nik" class="form-control" value="{{ old('nik') }}" maxlength="16" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" maxlength="35" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" maxlength="25" required>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" minlength="6" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="6" required>
                    </div>
                </div>
                <div class="mb-4 mt-3">
                    <label for="telp" class="form-label">No. Telepon</label>
                    <input type="text" id="telp" name="telp" class="form-control" value="{{ old('telp') }}" maxlength="13" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Daftar</button>

                <div class="text-center mt-3">
                    <small>Sudah punya akun? <a href="{{ route('masyarakat.login') }}">Login di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection