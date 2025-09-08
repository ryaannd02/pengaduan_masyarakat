

<?php $__env->startSection('content'); ?>
<div class="card shadow-sm border-0">
    <div class="card-header fw-bold bg-primary text-white">
        <i class="bi bi-info-circle me-2"></i> Detail Pengaduan
    </div>
    <div class="card-body">
        <div class="mb-3">
            <p><strong>ID Pengaduan:</strong> <?php echo e($pengaduan->id_pengaduan); ?></p>
            <p><strong>Tanggal:</strong> <?php echo e(\Carbon\Carbon::parse($pengaduan->created_at)->format('d-m-Y')); ?></p>
            <p><strong>Isi Laporan:</strong> <?php echo e($pengaduan->isi_laporan); ?></p>
            <p><strong>Status Saat Ini:</strong> 
                <span class="badge 
                    <?php if($pengaduan->status === 'proses'): ?> bg-warning text-dark
                    <?php elseif($pengaduan->status === 'selesai'): ?> bg-success
                    <?php elseif($pengaduan->status === 'ditolak'): ?> bg-danger
                    <?php else: ?> bg-secondary
                    <?php endif; ?>">
                    <?php echo e(ucfirst($pengaduan->status)); ?>

                </span>
            </p>
            <p><strong>Foto:</strong></p>
            <?php if(!empty($pengaduan->foto)): ?>
                <img src="<?php echo e(asset('storage/' . $pengaduan->foto)); ?>" 
                    alt="Foto Pengaduan"
                    class="img-fluid rounded shadow-sm"
                    style="max-width:400px;">
            <?php else: ?>
                <span class="text-muted">Tidak ada foto</span>
            <?php endif; ?>
        </div>

        <hr>

        <form method="POST" action="<?php echo e(route('petugas.pengaduan.status', $pengaduan->id_pengaduan)); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label fw-semibold">Status Baru</label>
                <select name="status" class="form-select">
                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php if($pengaduan->status == $s): echo 'selected'; endif; ?>><?php echo e(ucfirst($s)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggapan</label>
                <textarea name="tanggapan" class="form-control" rows="3" placeholder="Tulis tanggapan Anda..." required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('petugas.pengaduan.index')); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan & Update
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/petugas/pengaduan/show.blade.php ENDPATH**/ ?>