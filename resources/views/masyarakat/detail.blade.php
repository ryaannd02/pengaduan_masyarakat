@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Detail Pengaduan</h4>
    <a href="{{ route('masyarakat.dashboard') }}" class="btn btn-sm btn-secondary mb-3">← Kembali ke Dashboard</a>

    <div class="card">
        <div class="card-header">
            Tanggal: {{ \Carbon\Carbon::parse($data->tgl_pengaduan)->format('d-m-Y') }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Status:
                <span class="badge 
                    @if ($data->status == 'belum diproses') bg-warning
                    @elseif ($data->status == 'proses') bg-info
                    @else bg-success
                    @endif
                ">
                    {{ ucfirst($data->status) }}
                </span>
            </h5>
            <p class="card-text mt-3"><strong>Isi Laporan:</strong><br>{{ $data->isi_laporan }}</p>
            <p class="mt-3"><strong>Foto Terkait:</strong></p>
            @if ($data->foto)
                <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto pengaduan" class="img-fluid rounded shadow-sm" style="max-width: 420px;">
            @else
                <p class="text-muted">Foto tidak tersedia.</p>
            @endif
        </div>
    </div>
</div>
@endsection