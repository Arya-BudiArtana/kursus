<?php

use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin,pegawai'])
->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
// Ini otomatis membuat 7 rute (index, create, store, edit, update, destroy)
// untuk LaptopController.
Route::resource('laptops', LaptopController::class);
});

require __DIR__.'/auth.php';
