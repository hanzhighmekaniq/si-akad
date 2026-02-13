<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Admin\JadwalAkademikController;
use App\Http\Controllers\Admin\RuangController;
use App\Http\Controllers\Admin\GolonganController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Dosen\MatakuliahController as DosenMatakuliah;
use App\Http\Controllers\Dosen\JadwalController as DosenJadwal;
use App\Http\Controllers\Dosen\PresensiController as DosenPresensi;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/dashboard');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('jadwal', JadwalAkademikController::class);
    Route::resource('ruang', RuangController::class);
    Route::resource('golongan', GolonganController::class);
});

// Dosen Routes
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [DosenDashboard::class, 'index'])->name('dashboard');
    Route::get('/matakuliah', [DosenMatakuliah::class, 'index'])->name('matakuliah.index');
    Route::get('/matakuliah/{kode_mk}', [DosenMatakuliah::class, 'show'])->name('matakuliah.show');
    Route::get('/jadwal', [DosenJadwal::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/{id}', [DosenJadwal::class, 'show'])->name('jadwal.show');
    Route::get('/presensi', [DosenPresensi::class, 'index'])->name('presensi.index');
    Route::get('/presensi/{id}/create', [DosenPresensi::class, 'create'])->name('presensi.create');
    Route::post('/presensi/{id}', [DosenPresensi::class, 'store'])->name('presensi.store');
    Route::get('/presensi/{id}', [DosenPresensi::class, 'show'])->name('presensi.show');
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');
});

// Profile Routes (available for all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
