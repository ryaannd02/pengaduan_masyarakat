

<?php $__env->startSection('title', 'Kelola Masyarakat'); ?>

<?php $__env->startSection('content'); ?>
<h4 class="mb-4">Kelola Akun Masyarakat</h4>

<?php if($masyarakat->isEmpty()): ?>
    <div class="alert alert-warning">
        Belum ada data masyarakat.
    </div>
<?php else: ?>
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Telp</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $masyarakat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($m->nama); ?></td>
                    <td><?php echo e($m->username); ?></td>
                    <td><?php echo e($m->telp); ?></td>
                    <td>
                        
                        <?php if(!empty($m->id_masyarakat)): ?>
                            <a href="<?php echo e(route('admin.masyarakat.show', $m->id_masyarakat)); ?>" 
                               class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Detail tidak tersedia</span>
                        <?php endif; ?>

                        
                        <?php if(!empty($m->id_masyarakat)): ?>
                            <form action="<?php echo e(route('admin.masyarakat.destroy', $m->id_masyarakat)); ?>"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus akun ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/admin/masyarakat/index.blade.php ENDPATH**/ ?>