


<?php $__env->startSection('title', 'Dashboard Petugas'); ?>
<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row g-3 mb-4">
        
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-inbox-fill" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Total Pengaduan</h6>
                        <h2 class="fw-bold mb-0"><?php echo e($counts['total'] ?? 0); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-hourglass-split" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Belum Diproses</h6>
                        <h2 class="fw-bold mb-0"><?php echo e($counts['belum'] ?? 0); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-gear-fill" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Diproses</h6>
                        <h2 class="fw-bold mb-0"><?php echo e($counts['proses'] ?? 0); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-dark">
                        <i class="bi bi-check-circle-fill" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Selesai</h6>
                        <h2 class="fw-bold mb-0"><?php echo e($counts['selesai'] ?? 0); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/petugas/dashboard.blade.php ENDPATH**/ ?>