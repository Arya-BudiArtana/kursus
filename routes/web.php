<?php

use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\PeminjamanLaptopController;
use App\Http\Controllers\ProfileController;
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
    Route::resource('laptop', LaptopController::class);

    //...../admin/peminjman-laptop
    Route::get('/peminjaman-laptop', [PeminjamanLaptopController::class, 'index'])->name('peminjamanlaptop.index');
    Route::get('/peminjaman-laptop-create', [PeminjamanLaptopController::class, 'create'])->name('peminjamanlaptop.create');
    Route::post('/peminjaman-laptop-store', [PeminjamanLaptopController::class, 'store'])->name('peminjamanlaptop.store');

    // Route::post('/peminjaman-laptop-store', [PeminjamanLaptopController::class, 'savePeminjaman'])->name('peminjamanlaptop.savepeminjaman');
});

require __DIR__ . '/auth.php';
