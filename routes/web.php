<?php

use Illuminate\Support\Facades\Route;

// ==========================
// Controller Admin
// ==========================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MasyarakatController as AdminMasyarakatController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController; // 🔹 tambahan

// ==========================
// Controller Masyarakat
// ==========================
use App\Http\Controllers\Masyarakat\AuthController as MasyarakatAuthController;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboard;
use App\Http\Controllers\Masyarakat\PengaduanController as MasyarakatPengaduan;

// Middleware Masyarakat
use App\Http\Middleware\MasyarakatAuth;
use App\Http\Middleware\AuthMasyarakatMiddleware;

// ==========================
// Controller Petugas
// ==========================
use App\Http\Controllers\Petugas\AuthController as PetugasAuthController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduan;

// Middleware Petugas
use App\Http\Middleware\PetugasAuth as PetugasAuthMiddleware;

// ==========================
// Redirect default
// ==========================
Route::get('/', fn() => redirect()->route('masyarakat.login'))->name('home');

// ==========================
// Grup URL Masyarakat
// ==========================
Route::prefix('masyarakat')->name('masyarakat.')->group(function () {

    // Guest-only
    Route::middleware([MasyarakatAuth::class])->group(function () {
        Route::get('/login', [MasyarakatAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [MasyarakatAuthController::class, 'login'])->name('login.submit');

        Route::get('/register', [MasyarakatAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [MasyarakatAuthController::class, 'register'])->name('register.submit');
    });

    // Protected
    Route::middleware([AuthMasyarakatMiddleware::class])->group(function () {
        Route::post('/logout', [MasyarakatAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [MasyarakatDashboard::class, 'index'])->name('dashboard');

        Route::get('/pengaduan', [MasyarakatPengaduan::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/create', [MasyarakatPengaduan::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [MasyarakatPengaduan::class, 'store'])->name('pengaduan.store');
        Route::get('/pengaduan/{id}', [MasyarakatPengaduan::class, 'show'])->name('pengaduan.show');
        Route::put('/pengaduan/{id}', [MasyarakatPengaduan::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{id}', [MasyarakatPengaduan::class, 'destroy'])->name('pengaduan.destroy');
    });
});

// ==========================
// Grup URL Petugas
// ==========================
Route::prefix('petugas')->name('petugas.')->group(function () {

    // Guest-only
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [PetugasAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [PetugasAuthController::class, 'login'])->name('login.post');
    });

    // Protected
    Route::middleware([PetugasAuthMiddleware::class])->group(function () {
        Route::post('/logout', [PetugasAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');

        Route::get('/pengaduan', [PetugasPengaduan::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [PetugasPengaduan::class, 'show'])->name('pengaduan.show');

        Route::post('/pengaduan/{id}/status', [PetugasPengaduan::class, 'updateStatus'])->name('pengaduan.status');
        Route::post('/pengaduan/{id}/tanggapan', [PetugasPengaduan::class, 'storeTanggapan'])->name('pengaduan.tanggapan');
    });
});

// ==========================
// Grup URL Admin
// ==========================
Route::middleware(['auth.petugas', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
        Route::post('/logout', [PetugasAuthController::class, 'logout'])
            ->name('logout');

        // Resource: index untuk daftar, show untuk detail
        Route::resource('masyarakat', AdminMasyarakatController::class)
            ->only(['index', 'show', 'destroy']);
        Route::resource('petugas', AdminPetugasController::class);
        Route::resource('pengaduan', AdminPengaduanController::class);
    });


// ==========================
// Fallback
// ==========================
Route::fallback(fn() => response('Halaman tidak ditemukan.', 404));