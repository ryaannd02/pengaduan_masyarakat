@extends('layouts.petugas')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header fw-bold bg-primary text-white">
        <i class="bi bi-info-circle me-2"></i> Detail Pengaduan
    </div>
    <div class="card-body">
        <div class="mb-3">
            <p><strong>ID Pengaduan:</strong> {{ $pengaduan->id_pengaduan }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d-m-Y') }}</p>
            <p><strong>Isi Laporan:</strong> {{ $pengaduan->isi_laporan }}</p>
            <p><strong>Status Saat Ini:</strong> 
                <span class="badge 
                    @if($pengaduan->status === 'proses') bg-warning text-dark
                    @elseif($pengaduan->status === 'selesai') bg-success
                    @elseif($pengaduan->status === 'ditolak') bg-danger
                    @else bg-secondary
                    @endif">
                    {{ ucfirst($pengaduan->status) }}
                </span>
            </p>
            <p><strong>Foto:</strong></p>
            @if(!empty($pengaduan->foto))
                <img src="{{ asset('storage/' . $pengaduan->foto) }}" 
                    alt="Foto Pengaduan"
                    class="img-fluid rounded shadow-sm"
                    style="max-width:400px;">
            @else
                <span class="text-muted">Tidak ada foto</span>
            @endif
        </div>

        <hr>

        <form method="POST" action="{{ route('petugas.pengaduan.status', $pengaduan->id_pengaduan) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Status Baru</label>
                <select name="status" class="form-select">
                    @foreach($status as $s)
                        <option value="{{ $s }}" @selected($pengaduan->status == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggapan</label>
                <textarea name="tanggapan" class="form-control" rows="3" placeholder="Tulis tanggapan Anda..." required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('petugas.pengaduan.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan & Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection