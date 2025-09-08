

<?php echo app('Illuminate\Foundation\Vite')(['resources/css/login.css']); ?>

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-sm" style="width:100%;max-width:400px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-4">Login Masyarakat</h4>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php elseif(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('masyarakat.login.submit')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text"
                        id="nik"
                        name="nik"
                        class="form-control"
                        value="<?php echo e(old('nik')); ?>"
                        required
                        autofocus
                        placeholder="Masukkan NIK 16 digit"
                        pattern="\d{16}"
                        title="Masukkan 16 digit angka NIK"
                        maxlength="16">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="<?php echo e(route('masyarakat.register')); ?>">Daftar di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/masyarakat/login.blade.php ENDPATH**/ ?>