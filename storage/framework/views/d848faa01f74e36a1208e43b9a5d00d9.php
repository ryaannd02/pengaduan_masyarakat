<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Dashboard Admin'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/petugas.css'); ?>
</head>
<body>

<div class="layout-wrapper d-flex">

    
    <div class="sidebar p-3">
        <div class="sidebar-header mb-4">
            <h5 class="text-white text-uppercase">Pengaduan Masyarakat</h5>
        </div>

        
        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="nav-link w-100 text-start mb-2 <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        
        <button type="button"
                class="nav-link toggle w-100 text-start mb-2 <?php echo e(request()->is('admin/pengaduan*') ? 'active' : ''); ?>"
                aria-expanded="<?php echo e(request()->is('admin/pengaduan*') ? 'true' : 'false'); ?>">
            <i class="bi bi-inboxes me-2"></i> Pengaduan
            <i class="bi bi-chevron-down ms-auto caret"></i>
        </button>
        <ul class="collapse-panel menu list-unstyled ps-3 <?php echo e(request()->is('admin/pengaduan*') ? 'show' : ''); ?>">
            <?php $__currentLoopData = ['belum diproses','proses','selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(route('admin.pengaduan.index', ['status' => $status])); ?>"
                       class="menu-link d-block py-1 <?php echo e(request('status') === $status ? 'active' : ''); ?>">
                        <?php echo e(ucfirst($status)); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <a href="<?php echo e(route('admin.masyarakat.index')); ?>"
        class="nav-link <?php echo e(request()->routeIs('admin.masyarakat.*') ? 'active' : ''); ?>">
            <i class="bi bi-people me-2"></i> Masyarakat
        </a>


        
        <a href="<?php echo e(route('admin.petugas.index')); ?>"
           class="nav-link w-100 text-start mb-2 <?php echo e(request()->routeIs('admin.petugas.*') ? 'active' : ''); ?>">
            <i class="bi bi-person-badge me-2"></i> Petugas
        </a>
    </div>

    
    <div class="flex-grow-1 d-flex flex-column">
        
        <nav class="topbar d-flex justify-content-between align-items-center px-3">
            <span class="fw-semibold">
                Selamat datang, <?php echo e(auth('petugas')->user()->nama_petugas ?? 'Admin'); ?>

            </span>
            <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="m-0">
                <?php echo csrf_field(); ?>
                <button class="btn btn-sm btn-danger">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </nav>

        
        <main class="content-wrapper p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

</div>


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
</html><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/layouts/admin.blade.php ENDPATH**/ ?>