@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-sm" style="width:100%;max-width:400px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-4">Login Petugas / Admin</h4>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @elseif (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('petugas.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection