{{-- resources/views/layouts/petugas.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Petugas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Custom CSS --}}
    @vite('resources/css/petugas.css')
</head>
<body>

<div class="layout-wrapper d-flex">

    {{-- ===== SIDEBAR ===== --}}
    <div class="sidebar p-3">
        <div class="sidebar-header mb-4">
            <h5 class="text-white text-uppercase">Pengaduan Masyarakat</h5>
        </div>

        {{-- Dashboard langsung --}}
        <a href="{{ route('petugas.dashboard') }}"
           class="nav-link w-100 text-start mb-2 {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        {{-- Menu Pengaduan (dropdown) --}}
        <button type="button" class="nav-link toggle w-100 text-start mb-2" aria-expanded="{{ request()->is('petugas/pengaduan*') ? 'true' : 'false' }}">
            <i class="bi bi-inboxes me-2"></i> Pengaduan
            <i class="bi bi-chevron-down ms-auto caret"></i>
        </button>
        <ul class="collapse-panel menu list-unstyled ps-3 {{ request()->is('petugas/pengaduan*') ? 'show' : '' }}">
            <li>
                <a href="{{ route('petugas.pengaduan.index', ['status' => 'belum diproses']) }}"
                   class="menu-link d-block py-1 {{ request('status')=='belum diproses' ? 'active' : '' }}">
                    Belum diproses
                </a>
            </li>
            <li>
                <a href="{{ route('petugas.pengaduan.index', ['status' => 'proses']) }}"
                   class="menu-link d-block py-1 {{ request('status')=='proses' ? 'active' : '' }}">
                    Proses
                </a>
            </li>
            <li>
                <a href="{{ route('petugas.pengaduan.index', ['status' => 'selesai']) }}"
                   class="menu-link d-block py-1 {{ request('status')=='selesai' ? 'active' : '' }}">
                    Selesai
                </a>
            </li>
        </ul>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-grow-1 d-flex flex-column">
        {{-- Topbar --}}
        <nav class="topbar d-flex justify-content-between align-items-center px-3">
            <span class="fw-semibold">
                Selamat datang, {{ auth('petugas')->user()->nama_petugas ?? 'Petugas' }}
            </span>
            <form action="{{ route('petugas.logout') }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-sm btn-danger">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </nav>

        {{-- Content --}}
        <main class="content-wrapper p-4">
            @yield('content')
        </main>
    </div>

</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
{{-- Toggle script --}}
<script>
    document.querySelectorAll('.toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('active');
            btn.nextElementSibling.classList.toggle('show');
        });
    });
</script>
</body>
</html>