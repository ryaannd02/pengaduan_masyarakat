@extends('layouts.admin')

@section('title', 'Kelola Masyarakat')

@section('content')
<h4 class="mb-4">Kelola Akun Masyarakat</h4>

@if($masyarakat->isEmpty())
    <div class="alert alert-warning">
        Belum ada data masyarakat.
    </div>
@else
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Telp</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($masyarakat as $m)
                <tr>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->username }}</td>
                    <td>{{ $m->telp }}</td>
                    <td>
                        {{-- Tombol Detail (hanya jika ID ada) --}}
                        @if(!empty($m->id_masyarakat))
                            <a href="{{ route('admin.masyarakat.show', $m->id_masyarakat) }}" 
                               class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        @else
                            <span class="text-muted">Detail tidak tersedia</span>
                        @endif

                        {{-- Tombol Hapus --}}
                        @if(!empty($m->id_masyarakat))
                            <form action="{{ route('admin.masyarakat.destroy', $m->id_masyarakat) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection