@extends('layouts.app')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

<div class="container mt-4 detail-pengaduan">
    <h4 class="mb-4">📄 Detail Pengaduan</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <strong>Tanggal Pengaduan:</strong>
                <span>{{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d-m-Y') }}</span>
            </div>

            <div class="mb-3">
                <strong>Isi Laporan:</strong>
                <p class="isi-laporan">{{ $pengaduan->isi_laporan }}</p>
            </div>

            <div class="mb-3">
                <strong>Status:</strong>
                <span class="badge 
                    @if ($pengaduan->status == 'belum diproses') bg-warning text-dark
                    @elseif ($pengaduan->status == 'proses') bg-info
                    @else bg-success
                    @endif
                ">
                    {{ ucfirst($pengaduan->status) }}
                </span>
            </div>

            <div class="mb-3">
                <strong>Foto:</strong><br>
                <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                    alt="Foto Pengaduan"
                    class="img-fluid rounded foto-pengaduan">
            </div>

            <div class="mb-3">
                <strong>Tanggapan Petugas:</strong>
                @if ($pengaduan->status == 'belum diproses')
                    <span class="text-muted">-</span>
                @elseif ($pengaduan->status == 'proses' && empty($pengaduan->tanggapan_petugas))
                    <span class="text-muted">-</span>
                @else
                    <p class="tanggapan">{{ $pengaduan->tanggapan_petugas }}</p>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('masyarakat.pengaduan.index') }}" class="btn btn-secondary mt-4">
        ← Kembali
    </a>
</div>

@endsection