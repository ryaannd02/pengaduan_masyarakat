

<?php $__env->startSection('title', 'Tambah Petugas'); ?>

<?php $__env->startSection('content'); ?>
<h4 class="mb-4">Tambah Petugas</h4>

<form action="<?php echo e(route('admin.petugas.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label for="nama_petugas" class="form-label">Nama Petugas</label>
        <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="telp" class="form-label">Telp</label>
        <input type="text" name="telp" id="telp" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    
    <div class="mb-3">
        <label for="level" class="form-label">Level</label>
        <select name="level" id="level" class="form-select" required>
            <option value="">-- Pilih Level --</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?php echo e(route('admin.petugas.index')); ?>" class="btn btn-secondary">Batal</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/admin/petugas/create.blade.php ENDPATH**/ ?>