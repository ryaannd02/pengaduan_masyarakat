<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin')</title>
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

    {{-- SIDEBAR --}}
    <div class="sidebar p-3">
        <div class="sidebar-header mb-4">
            <h5 class="text-white text-uppercase">Pengaduan Masyarakat</h5>
        </div>

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link w-100 text-start mb-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        {{-- Pengaduan --}}
        <button type="button"
                class="nav-link toggle w-100 text-start mb-2 {{ request()->is('admin/pengaduan*') ? 'active' : '' }}"
                aria-expanded="{{ request()->is('admin/pengaduan*') ? 'true' : 'false' }}">
            <i class="bi bi-inboxes me-2"></i> Pengaduan
            <i class="bi bi-chevron-down ms-auto caret"></i>
        </button>
        <ul class="collapse-panel menu list-unstyled ps-3 {{ request()->is('admin/pengaduan*') ? 'show' : '' }}">
            @foreach (['belum diproses','proses','selesai'] as $status)
                <li>
                    <a href="{{ route('admin.pengaduan.index', ['status' => $status]) }}"
                       class="menu-link d-block py-1 {{ request('status') === $status ? 'active' : '' }}">
                        {{ ucfirst($status) }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Masyarakat --}}
        <a href="{{ route('admin.masyarakat.index') }}"
        class="nav-link {{ request()->routeIs('admin.masyarakat.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Masyarakat
        </a>


        {{-- Petugas --}}
        <a href="{{ route('admin.petugas.index') }}"
           class="nav-link w-100 text-start mb-2 {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge me-2"></i> Petugas
        </a>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="flex-grow-1 d-flex flex-column">
        {{-- Topbar --}}
        <nav class="topbar d-flex justify-content-between align-items-center px-3">
            <span class="fw-semibold">
                Selamat datang, {{ auth('petugas')->user()->nama_petugas ?? 'Admin' }}
            </span>
            <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
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