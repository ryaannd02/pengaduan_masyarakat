

<?php echo app('Illuminate\Foundation\Vite')('resources/css/registrasi.css'); ?>

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-sm" style="width:100%;max-width:480px;">
        <div class="card-body p-4">
            <h4 class="text-center mb-1">Registrasi Masyarakat</h4>
            <p class="text-center text-muted mb-4">Buat akun untuk mengirim pengaduan & memantau prosesnya</p>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($err); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('masyarakat.register.submit')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" id="nik" name="nik" class="form-control" value="<?php echo e(old('nik')); ?>" maxlength="16" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo e(old('nama')); ?>" maxlength="35" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo e(old('username')); ?>" maxlength="25" required>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" minlength="6" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="6" required>
                    </div>
                </div>
                <div class="mb-4 mt-3">
                    <label for="telp" class="form-label">No. Telepon</label>
                    <input type="text" id="telp" name="telp" class="form-control" value="<?php echo e(old('telp')); ?>" maxlength="13" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Daftar</button>

                <div class="text-center mt-3">
                    <small>Sudah punya akun? <a href="<?php echo e(route('masyarakat.login')); ?>">Login di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/masyarakat/registrasi.blade.php ENDPATH**/ ?>