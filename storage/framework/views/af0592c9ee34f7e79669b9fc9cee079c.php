

<?php $__env->startSection('content'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/show.css')); ?>">
<?php $__env->stopPush(); ?>

<div class="container mt-4 detail-pengaduan">
    <h4 class="mb-4">📄 Detail Pengaduan</h4>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <strong>Tanggal Pengaduan:</strong>
                <span><?php echo e(\Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d-m-Y')); ?></span>
            </div>

            <div class="mb-3">
                <strong>Isi Laporan:</strong>
                <p class="isi-laporan"><?php echo e($pengaduan->isi_laporan); ?></p>
            </div>

            <div class="mb-3">
                <strong>Status:</strong>
                <span class="badge 
                    <?php if($pengaduan->status == 'belum diproses'): ?> bg-warning text-dark
                    <?php elseif($pengaduan->status == 'proses'): ?> bg-info
                    <?php else: ?> bg-success
                    <?php endif; ?>
                ">
                    <?php echo e(ucfirst($pengaduan->status)); ?>

                </span>
            </div>

            <div class="mb-3">
                <strong>Foto:</strong><br>
                <img src="<?php echo e(asset('storage/' . $pengaduan->foto)); ?>"
                    alt="Foto Pengaduan"
                    class="img-fluid rounded foto-pengaduan">
            </div>

            <div class="mb-3">
                <strong>Tanggapan Petugas:</strong>
                <?php if($pengaduan->status == 'belum diproses'): ?>
                    <span class="text-muted">-</span>
                <?php elseif($pengaduan->status == 'proses' && empty($pengaduan->tanggapan_petugas)): ?>
                    <span class="text-muted">-</span>
                <?php else: ?>
                    <p class="tanggapan"><?php echo e($pengaduan->tanggapan_petugas); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <a href="<?php echo e(route('masyarakat.pengaduan.index')); ?>" class="btn btn-secondary mt-4">
        ← Kembali
    </a>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/masyarakat/pengaduan/show.blade.php ENDPATH**/ ?>