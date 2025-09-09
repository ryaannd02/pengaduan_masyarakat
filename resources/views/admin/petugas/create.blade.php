@extends('layouts.admin')

@section('title', 'Tambah Petugas')

@section('content')
<h4 class="mb-4">Tambah Petugas</h4>

{{-- Tampilkan error jika ada --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.petugas.store') }}" method="POST">
    @csrf

    {{-- Nama Petugas --}}
    <div class="mb-3">
        <label for="nama_petugas" class="form-label">Nama Petugas</label>
        <input type="text" name="nama_petugas" id="nama_petugas"
               class="form-control @error('nama_petugas') is-invalid @enderror"
               value="{{ old('nama_petugas') }}" required>
        @error('nama_petugas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Username --}}
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username"
               class="form-control @error('username') is-invalid @enderror"
               value="{{ old('username') }}" required>
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Telp --}}
    <div class="mb-3">
        <label for="telp" class="form-label">Telp</label>
        <input type="text" name="telp" id="telp"
               class="form-control @error('telp') is-invalid @enderror"
               value="{{ old('telp') }}" required>
        @error('telp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password"
               class="form-control @error('password') is-invalid @enderror"
               autocomplete="new-password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Level --}}
    <div class="mb-3">
        <label for="level" class="form-label">Level</label>
        <select name="level" id="level"
                class="form-select @error('level') is-invalid @enderror" required>
            <option value="">-- Pilih Level --</option>
            <option value="admin" {{ old('level') === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ old('level') === 'petugas' ? 'selected' : '' }}>Petugas</option>
        </select>
        @error('level')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection