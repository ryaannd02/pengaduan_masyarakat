@extends('layouts.admin')

@section('title', 'Tambah Petugas')

@section('content')
<h4 class="mb-4">Tambah Petugas</h4>

<form action="{{ route('admin.petugas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama_petugas" class="form-label">Nama Petugas</label>
        <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="telp" class="form-label">Telp</label>
        <input type="text" name="telp" id="telp" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    {{-- Pilihan Level --}}
    <div class="mb-3">
        <label for="level" class="form-label">Level</label>
        <select name="level" id="level" class="form-select" required>
            <option value="">-- Pilih Level --</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection