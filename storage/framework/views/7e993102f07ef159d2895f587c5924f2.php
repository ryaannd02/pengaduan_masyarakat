

<?php echo app('Illuminate\Foundation\Vite')('resources/css/dashboard.css'); ?>

<?php $__env->startSection('content'); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-dark" href="#welcome">Pengaduan Masyarakat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
    <ul class="navbar-nav ms-auto gap-3 align-items-center">
        <li class="nav-item"><a class="nav-link" href="#form-pengaduan">Tulis Pengaduan</a></li>
        <li class="nav-item"><a class="nav-link" href="#pengaduan-saya">Riwayat Saya</a></li>
        <li class="nav-item"><a class="nav-link" href="#tentang-kami">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="#cara-pakai">Cara Pakai</a></li>
        <li class="nav-item d-flex align-items-center">
            <form action="<?php echo e(route('masyarakat.logout')); ?>" method="POST" class="m-0">
                <?php echo csrf_field(); ?>
                <button class="btn btn-sm btn-outline-danger">Logout</button>
            </form>
        </li>
    </ul>
    </div>
  </div>
</nav>

<section id="welcome" class="hero py-5">
  <div class="container text-center">
    <h1>Halo, <?php echo e(session('masyarakat.nama')); ?></h1>
    <p class="lead">Sampaikan laporan Anda dan bantu lingkungan jadi lebih baik.</p>
    <?php if(session('success')): ?>
      <div class="alert alert-success mt-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <a href="#pengaduan-saya" class="btn btn-brand mt-3">Lihat Pengaduan</a>
  </div>
</section>

<section id="form-pengaduan" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold display-6 text-primary">Tulis Pengaduan</h2>
      <p class="text-secondary">Laporkan masalah Anda dengan cepat dan mudah melalui formulir ini</p>
    </div>

    <div class="form-wrapper mx-auto p-4 p-md-5 shadow-lg rounded-4 bg-white">
      <form action="<?php echo e(route('masyarakat.pengaduan.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
          <label for="tgl" class="form-label fw-semibold">📅 Tanggal</label>
          <input type="date" name="tgl_pengaduan" id="tgl" 
                 value="<?php echo e(date('Y-m-d')); ?>" 
                 class="form-control" required>
        </div>

        <div class="mb-4">
          <label for="isi" class="form-label fw-semibold">📝 Isi Laporan</label>
          <textarea name="isi_laporan" id="isi" class="form-control" rows="5" 
                    placeholder="Tuliskan laporan secara jelas dan detail..." required></textarea>
        </div>

        <div class="mb-4">
          <label for="foto" class="form-label fw-semibold">📷 Unggah Foto</label>
          <input type="file" name="foto" id="foto" 
                 class="form-control" accept=".jpg,.jpeg,.png" required>
          <small class="text-muted d-block mt-1">*Format: JPG/PNG, Max 2MB</small>
          <div id="preview" class="mt-3 text-center"></div>
        </div>

        <?php if($errors->any()): ?>
          <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($err); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-lg btn-primary px-5 py-2 rounded-pill shadow-sm">
            Kirim Laporan
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<section id="pengaduan-saya" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Pengaduan Anda</h2>
      <p class="text-muted">Daftar pengaduan yang telah Anda kirimkan</p>
    </div>

    <?php if(!isset($pengaduan) || $pengaduan->isEmpty()): ?>
      <div class="text-center py-4">
        <p class="text-muted mb-0">Belum ada pengaduan yang dikirim.</p>
      </div>
    <?php else: ?>
      <div class="row g-4" id="pengaduan-list">
        <?php $__currentLoopData = $pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $statusClass = match($p->status) {
              'belum diproses' => 'status-warning',
              'proses' => 'status-info',
              default => 'status-success',
            };
            $statusIcon = match($p->status) {
              'belum diproses' => 'bi-hourglass-split',
              'proses' => 'bi-gear-fill',
              default => 'bi-check-circle-fill',
            };
          ?>

          <div class="col-md-6 pengaduan-item <?php echo e($index >= 4 ? 'd-none' : ''); ?>">
            <div class="pengaduan-card h-100">
              <div class="pengaduan-card-header d-flex justify-content-between align-items-center <?php echo e($statusClass); ?>">
                <div class="d-flex align-items-center gap-2 text-white">
                  <i class="bi <?php echo e($statusIcon); ?>"></i>
                  <span class="fw-semibold"><?php echo e(ucfirst($p->status)); ?></span>
                </div>
                <small><?php echo e(\Carbon\Carbon::parse($p->tgl_pengaduan)->format('d-m-Y')); ?></small>
              </div>
              <div class="pengaduan-card-body p-3">
                <p class="mb-3"><?php echo e(\Illuminate\Support\Str::limit($p->isi_laporan, 120)); ?></p>
                <div class="text-end">
                  <a href="<?php echo e(route('masyarakat.pengaduan.show', $p->id_pengaduan)); ?>" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Detail</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <?php if($pengaduan->count() > 4): ?>
        <div class="text-center mt-4">
          <button id="toggle-pengaduan" type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
            Lihat Lebih Banyak
          </button>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const btnToggle = document.getElementById('toggle-pengaduan');
  const items = document.querySelectorAll('.pengaduan-item');
  let expanded = false;

  if (btnToggle) {
    btnToggle.addEventListener('click', function () {
      expanded = !expanded;

      items.forEach((item, index) => {
        if (index >= 4) {
          item.classList.toggle('d-none', !expanded);
        }
      });

      btnToggle.textContent = expanded ? 'Tutup' : 'Lihat Lebih Banyak';
    });
  }
});
</script>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const btnToggle = document.getElementById('toggle-pengaduan');
  const items = document.querySelectorAll('.pengaduan-item');
  let expanded = false;

  if (btnToggle) {
    btnToggle.addEventListener('click', function () {
      expanded = !expanded;

      items.forEach((item, index) => {
        if (index >= 4) {
          if (expanded) {
            item.classList.remove('d-none');
          } else {
            item.classList.add('d-none');
          }
        }
      });

      btnToggle.textContent = expanded ? 'Tutup' : 'Lihat Lebih Banyak';
    });
  }
});
</script>
<?php $__env->stopPush(); ?>

<section id="tentang-kami" class="section-tentang py-5 bg-light">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="section-title">Tentang Kami</h2>
      <p class="tentang-desc mx-auto" style="max-width: 720px;">
        Aplikasi <strong>Pengaduan Masyarakat</strong> dirancang untuk memudahkan warga dalam menyampaikan laporan publik kepada instansi terkait. Kami menjunjung tinggi transparansi, kecepatan, dan aksesibilitas layanan.
      </p>
    </div>

    <div class="row justify-content-center g-4">
      <div class="col-md-4">
        <div class="info-box text-center shadow-sm p-4 rounded bg-white">
          <i class="bi bi-people-fill info-icon text-primary fs-2 mb-3"></i>
          <h5 class="fw-semibold">Mudah Diakses</h5>
          <p class="text-muted small">Siap digunakan oleh masyarakat dari berbagai lapisan tanpa kesulitan teknis.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box text-center shadow-sm p-4 rounded bg-white">
          <i class="bi bi-lightning-fill info-icon text-warning fs-2 mb-3"></i>
          <h5 class="fw-semibold">Cepat & Responsif</h5>
          <p class="text-muted small">Laporan langsung diproses secara digital tanpa birokrasi yang berbelit.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box text-center shadow-sm p-4 rounded bg-white">
          <i class="bi bi-shield-check info-icon text-success fs-2 mb-3"></i>
          <h5 class="fw-semibold">Terpercaya & Aman</h5>
          <p class="text-muted small">Data laporan dan identitas dijaga sesuai prinsip privasi pengguna.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="cara-pakai" class="cara-pakai-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Cara Pakai</h2>
      <p class="text-muted">Empat langkah mudah untuk menyampaikan pengaduan Anda</p>
    </div>

    <div class="row g-4">
      <?php
        $steps = [
          ['icon' => 'bi-pencil-square', 'title' => 'Isi laporan & unggah foto', 'color' => 'primary'],
          ['icon' => 'bi-shield-check',  'title' => 'Verifikasi oleh tim', 'color' => 'warning'],
          ['icon' => 'bi-graph-up-arrow', 'title' => 'Pantau status laporan', 'color' => 'info'],
          ['icon' => 'bi-check-circle-fill', 'title' => 'Laporan ditutup', 'color' => 'success'],
        ];
      ?>

      <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-6 col-lg-3">
        <div class="step-card h-100 text-center p-4 border-0 shadow-sm">
          <div class="step-icon bg-<?php echo e($step['color']); ?> bg-gradient text-white mx-auto mb-3">
            <i class="bi <?php echo e($step['icon']); ?>"></i>
          </div>
          <h5 class="fw-semibold mb-2">Langkah <?php echo e($index + 1); ?></h5>
          <p class="text-muted small mb-0"><?php echo e($step['title']); ?></p>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="text-center mt-5">
      <a href="#form-pengaduan" class="btn btn-brand btn-lg px-4">Mulai Pengaduan</a>
    </div>
  </div>
</section>

<footer class="site-footer mt-5">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-md-6">
        <h6 class="footer-heading">Tentang Aplikasi</h6>
        <ul class="list-unstyled footer-list">
          <li><a class="footer-link" href="#welcome">Beranda</a></li>
          <li><a class="footer-link" href="#tentang-kami">Tentang Kami</a></li>
          <li><a class="footer-link" href="#cara-pakai">Cara Penggunaan</a></li>
        </ul>
      </div>

      <div class="col-md-6">
        <h6 class="footer-heading text-md-end">Hubungi Kami</h6>
        <ul class="list-unstyled footer-list text-md-end">
          <li><a class="footer-link" href="mailto:admin@pengaduan.local">pengaduanmasyarakat@gmail.com</a></li>
          <li><a class="footer-link" href="tel:+6281234567890">+62 812-3456-7890</a></li>
          <li><a class="footer-link" href="#">@PengaduanMasyarakat</a></li>
        </ul>
      </div>
    </div>

    <hr class="footer-sep">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-3">
      <div class="d-flex align-items-center gap-2">
        <span class="brand-text fw-bold">Pengaduan Masyarakat</span>
        <div class="footer-social d-flex gap-2">
          <a class="social-btn" href="#" aria-label="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
          <a class="social-btn" href="#" aria-label="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a class="social-btn" href="#" aria-label="LinkedIn">
            <i class="bi bi-linkedin"></i>
          </a>
        </div>
      </div>
      <small class="text-muted text-md-end">
        &copy; <?php echo e(date('Y')); ?> Pengaduan Masyarakat. Dibuat dengan Laravel.
      </small>
    </div>
  </div>
</footer>

<?php $__env->startPush('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        const nav = document.getElementById('mainNav');
        if (nav && nav.classList.contains('show')) {
          new bootstrap.Collapse(nav).hide();
        }
      });
    });
  });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pengaduan_masyarakat\resources\views/masyarakat/dashboard.blade.php ENDPATH**/ ?>