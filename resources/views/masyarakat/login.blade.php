@extends('layouts.app')

@vite(['resources/css/login.css'])

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-sm" style="width:100%;max-width:400px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-4">Login Masyarakat</h4>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @elseif (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('masyarakat.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text"
                        id="nik"
                        name="nik"
                        class="form-control"
                        value="{{ old('nik') }}"
                        required
                        autofocus
                        placeholder="Masukkan NIK 16 digit"
                        pattern="\d{16}"
                        title="Masukkan 16 digit angka NIK"
                        maxlength="16">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="{{ route('masyarakat.register') }}">Daftar di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection