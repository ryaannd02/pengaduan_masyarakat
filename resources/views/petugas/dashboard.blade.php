{{-- resources/views/petugas/dashboard.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container-fluid">
    <div class="row g-3 mb-4">
        {{-- Total Pengaduan --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-inbox-fill" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Total Pengaduan</h6>
                        <h2 class="fw-bold mb-0">{{ $counts['total'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Belum Diproses --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-hourglass-split" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Belum Diproses</h6>
                        <h2 class="fw-bold mb-0">{{ $counts['belum'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diproses --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-gear-fill" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Diproses</h6>
                        <h2 class="fw-bold mb-0">{{ $counts['proses'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-check-circle-fill" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Selesai</h6>
                        <h2 class="fw-bold mb-0">{{ $counts['selesai'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection