<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RuangController;
use App\Http\Controllers\Admin\GolonganController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Admin\JadwalAkademikController;
use App\Http\Controllers\Admin\PengampuController;
use App\Http\Controllers\Dosen\JadwalController as DosenJadwal;
use App\Http\Controllers\Mahasiswa\KrsController as MahasiswaKrs;
use App\Http\Controllers\Dosen\PresensiController as DosenPresensi;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Dosen\MatakuliahController as DosenMatakuliah;
use App\Http\Controllers\Mahasiswa\JadwalController as MahasiswaJadwal;
use App\Http\Controllers\Mahasiswa\PresensiController as MahasiswaPresensi;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return redirect()->route($user->role . '.dashboard');
    }
    return redirect()->route('login');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('jadwal', JadwalAkademikController::class);
    Route::resource('ruang', RuangController::class);
    Route::resource('golongan', GolonganController::class);
    Route::post('golongan/{golongan}/mahasiswa', [GolonganController::class, 'addMahasiswa'])->name('golongan.add-mahasiswa');
    Route::post('golongan/{golongan}/mahasiswa/pindahkan', [GolonganController::class, 'pindahkanMahasiswa'])->name('golongan.pindahkan-mahasiswa');
    Route::get('pengampu', [PengampuController::class, 'index'])->name('pengampu.index');
    Route::get('pengampu/create', [PengampuController::class, 'create'])->name('pengampu.create');
    Route::post('pengampu', [PengampuController::class, 'store'])->name('pengampu.store');
    Route::get('pengampu/{nip}', [PengampuController::class, 'show'])->name('pengampu.show');
    Route::get('pengampu/{nip}/edit', [PengampuController::class, 'edit'])->name('pengampu.edit');
    Route::put('pengampu/{nip}', [PengampuController::class, 'update'])->name('pengampu.update');
    Route::delete('pengampu', [PengampuController::class, 'destroy'])->name('pengampu.destroy');
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
    Route::get('/jadwal', [MahasiswaJadwal::class, 'index'])->name('jadwal.index');
    Route::get('/krs', [MahasiswaKrs::class, 'index'])->name('krs.index');
    Route::get('/presensi', [MahasiswaPresensi::class, 'index'])->name('presensi.index');
    Route::get('/presensi/create/{jadwalId}', [MahasiswaPresensi::class, 'create'])->name('presensi.create');
    Route::post('/presensi/store', [MahasiswaPresensi::class, 'store'])->name('presensi.store');
});

// Dashboard route (Breeze default) - redirect based on user role
Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();
    
    $route = match($user->role) {
        'admin' => 'admin.dashboard',
        'dosen' => 'dosen.dashboard',
        'mahasiswa' => 'mahasiswa.dashboard',
        default => 'login'
    };
    
    return redirect()->route($route);
})->name('dashboard');

// Profile Routes (available for all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
