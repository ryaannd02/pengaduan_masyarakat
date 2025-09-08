

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-sm" style="width:100%;max-width:400px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-4">Login Petugas / Admin</h4>

            <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
            <?php elseif(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('petugas.login.post')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="<?php echo e(old('username')); ?>" class="form-control" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/petugas/login.blade.php ENDPATH**/ ?>