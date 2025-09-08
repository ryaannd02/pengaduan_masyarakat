


<?php $__env->startSection('title', 'Pengaduan - ' . ucfirst($statusLabel)); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Data Pengaduan — <?php echo e(ucfirst($statusLabel)); ?></h5>
        <form method="GET" class="d-flex gap-2">
            <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
            <?php $show = (int) request('show', 10); ?>
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted small">Show</label>
                <select name="show" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php $__currentLoopData = [10,25,50,100]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($n); ?>" <?php echo e($show===$n?'selected':''); ?>><?php echo e($n); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-muted small">entries</span>
            </div>
            <div class="input-group input-group-sm" style="width: 260px;">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="Search...">
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
                        <?php $__empty_1 = true; $__currentLoopData = $pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $no = ($pengaduan->firstItem() ?? 1) + $i;
                                $badgeClass = match($p->status) {
                                    'belum diproses' => 'badge bg-secondary',
                                    'proses' => 'badge bg-warning text-dark',
                                    'selesai' => 'badge bg-success',
                                    default => 'badge bg-dark'
                                };
                            ?>
                            <tr>
                                <td><?php echo e($no); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($p->created_at)->format('d-m-Y')); ?></td>
                                <td><?php echo e($p->nama ?? '-'); ?></td>
                                <td class="text-truncate" style="max-width: 380px;" title="<?php echo e($p->isi_laporan); ?>">
                                    <?php echo e($p->isi_laporan); ?>

                                </td>
                                <td><span class="<?php echo e($badgeClass); ?>"><?php echo e(strtoupper($p->status)); ?></span></td>
                                <td>
                                    <a href="<?php echo e(route('petugas.pengaduan.show', $p->id_pengaduan)); ?>" class="btn btn-sm btn-info">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No data available in table</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="d-flex justify-content-between align-items-center px-3 py-2">
                <?php
                    $from = $pengaduan->firstItem() ?? 0;
                    $to   = $pengaduan->lastItem() ?? 0;
                    $tot  = $pengaduan->total() ?? 0;
                ?>
                <small class="text-muted">
                    Showing <?php echo e($from); ?> to <?php echo e($to); ?> of <?php echo e($tot); ?> entries
                </small>
                <div>
                    <?php echo e($pengaduan->onEachSide(1)->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/petugas/pengaduan/index.blade.php ENDPATH**/ ?>