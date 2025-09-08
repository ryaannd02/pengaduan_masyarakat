@extends('layouts.admin')

@section('title', 'Pengaduan - ' . ucfirst($statusLabel))

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Data Pengaduan — {{ ucfirst($statusLabel) }}</h5>
        <form method="GET" class="d-flex gap-2">
            <input type="hidden" name="status" value="{{ request('status') }}">
            @php $show = (int) request('show', 10); @endphp
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted small">Show</label>
                <select name="show" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach([10,25,50,100] as $n)
                        <option value="{{ $n }}" {{ $show===$n?'selected':'' }}>{{ $n }}</option>
                    @endforeach
                </select>
                <span class="text-muted small">entries</span>
            </div>
            <div class="input-group input-group-sm" style="width: 260px;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search...">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;">NO</th>
                            <th style="width: 140px;">TANGGAL</th>
                            <th style="width: 200px;">NAMA</th>
                            <th>ISI LAPORAN</th>
                            <th style="width: 120px;">STATUS</th>
                            <th style="width: 110px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduan as $i => $p)
                            @php
                                $no = ($pengaduan->firstItem() ?? 1) + $i;
                                $badgeClass = match($p->status) {
                                    'belum diproses' => 'badge bg-secondary',
                                    'proses' => 'badge bg-warning text-dark',
                                    'selesai' => 'badge bg-success',
                                    default => 'badge bg-dark'
                                };
                            @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $p->nama ?? '-' }}</td>
                                <td class="text-truncate" style="max-width: 380px;" title="{{ $p->isi_laporan }}">
                                    {{ $p->isi_laporan }}
                                </td>
                                <td><span class="{{ $badgeClass }}">{{ strtoupper($p->status) }}</span></td>
                                <td>
                                    <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}" class="btn btn-sm btn-info">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No data available in table</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center px-3 py-2">
                @php
                    $from = $pengaduan->firstItem() ?? 0;
                    $to   = $pengaduan->lastItem() ?? 0;
                    $tot  = $pengaduan->total() ?? 0;
                @endphp
                <small class="text-muted">
                    Showing {{ $from }} to {{ $to }} of {{ $tot }} entries
                </small>
                <div>
                    {{ $pengaduan->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection