
<?php $__env->startSection('title', 'Kelola Petugas'); ?>

<?php $__env->startSection('content'); ?>
<h4>Kelola Akun Petugas</h4>
<a href="<?php echo e(route('admin.petugas.create')); ?>" class="btn btn-primary mb-3">Tambah Petugas</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama</th><th>Username</th><th>Level</th><th>Telp</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $petugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($p->nama_petugas); ?></td>
            <td><?php echo e($p->username); ?></td>
            <td><?php echo e($p->level); ?></td>
            <td><?php echo e($p->telp); ?></td>
            <td>
                <form action="<?php echo e(route('admin.petugas.destroy', $p->id_petugas)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus akun ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/admin/petugas/index.blade.php ENDPATH**/ ?>