@extends('layouts.admin')
@section('title', 'Kelola Petugas')

@section('content')
<h4>Kelola Akun Petugas</h4>
<a href="{{ route('admin.petugas.create') }}" class="btn btn-primary mb-3">Tambah Petugas</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama</th><th>Username</th><th>Level</th><th>Telp</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($petugas as $p)
        <tr>
            <td>{{ $p->nama_petugas }}</td>
            <td>{{ $p->username }}</td>
            <td>{{ $p->level }}</td>
            <td>{{ $p->telp }}</td>
            <td>
                <form action="{{ route('admin.petugas.destroy', $p->id_petugas) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus akun ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection