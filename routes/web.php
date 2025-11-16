<?php

use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\PeminjamanKendaraanController;
use App\Http\Controllers\Admin\PeminjamanLaptopController;
use App\Http\Controllers\Pegawai\PeminjamanKendaraanController as PegawaiPeminjamanKendaraanController;
use App\Http\Controllers\ProfileController;
use App\Models\PeminjamanKendaraan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
    }
);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// === GRUP KHUSUS ADMIN ===
// Middleware 'auth' -> Harus login
// Middleware 'role:admin' -> Memanggil CheckRole.php, dan $role = 'admin'
// ----------------------------------------------------------------------
Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('kendaraans', KendaraanController::class);
    Route::resource('laptop', LaptopController::class);

    //...../admin/peminjman-laptop
    Route::get('/peminjaman-laptop', [PeminjamanLaptopController::class, 'index'])->name('peminjamanlaptop.index');
    Route::get('/peminjaman-laptop-create', [PeminjamanLaptopController::class, 'create'])->name('peminjamanlaptop.create');
    Route::post('/peminjaman-laptop-store', [PeminjamanLaptopController::class, 'store'])->name('peminjamanlaptop.store');
    Route::get('/peminjaman-laptop-edit/{id}', [PeminjamanLaptopController::class, 'edit'])->name('peminjamanlaptop.edit');
    Route::put('/peminjaman-laptop-edit/{id}/update', [PeminjamanLaptopController::class, 'update'])->name('peminjamanlaptop.update');
    Route::delete('/peminjaman-laptop/{id}/delete', [PeminjamanLaptopController::class, 'destroy'])->name('peminjamanlaptop.delete');

    // Route::resource('peminjaman-kendaraan', PeminjamanKendaraanController::class);
    Route::get('/peminjaman-kendaraan', [PeminjamanKendaraanController::class, 'index'])
        ->name('peminjaman-kendaraan.index');
    Route::get('/peminjaman-kendaraan/{id}/edit', [PeminjamanKendaraanController::class, 'edit'])
        ->name('peminjaman-kendaraan.edit');
    Route::put('/peminjaman-kendaraan/{id}/update', [PeminjamanKendaraanController::class, 'update'])
        ->name('peminjaman-kendaraan.update');
    Route::post('/peminjaman-kendaraan/{id}/approve', [PeminjamanKendaraanController::class, 'approvePinjaman'])
        ->name('peminjaman-kendaraan.approvePinjaman');
    Route::post('/peminjaman-kendaraan/{id}/tolak', [PeminjamanKendaraanController::class, 'tolakPinjaman'])
        ->name('peminjaman-kendaraan.tolakPinjaman');
    Route::post('/peminjaman-kendaraan/export', [PeminjamanKendaraanController::class, 'export'])
        ->name('peminjaman-kendaraan.export');

    // Route::post('/peminjaman-laptop-store', [PeminjamanLaptopController::class, 'savePeminjaman'])->name('peminjamanlaptop.savepeminjaman');
});

Route::middleware(['auth', 'role:2'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::resource('peminjaman-kendaraan', PegawaiPeminjamanKendaraanController::class);
    Route::get('/peminjaman-kendaraan-data/datatable', [PegawaiPeminjamanKendaraanController::class, 'datatable'])->name('peminjaman-kendaraan.datatable');
    Route::get('/peminjaman-kendaraan-data/export-excel', [PegawaiPeminjamanKendaraanController::class, 'export'])->name('peminjaman-kendaraan.export');
});

require __DIR__ . '/auth.php';
