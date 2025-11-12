<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KendaraanModel;
use App\Models\Laptop;
use App\Models\PeminjamanLaptop;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanLaptopController extends Controller
{


    public function index()
    {
        $data_peminjaman = PeminjamanLaptop::with(['user', 'laptop'])->latest()->paginate(10);
        // dd($data_peminjaman);

        return view('admin.peminjaman_laptop.index', compact('data_peminjaman'));
    }

    public function create()
    {
        $data_user   = User::get();
        $data_laptop = Laptop::get();

        // dd($data_user, $data_laptop);
        return view('admin.peminjaman_laptop.create', compact('data_user', 'data_laptop'));
    }

    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'user_id' => 'required',
            'laptop_id' => 'required',
            'tgl_pinjam' => 'required', // Asumsi min tahun 2000
        ]);

        PeminjamanLaptop::create([
            'user_id' => $request->user_id,
            'laptop_id' => $request->laptop_id,
            'tgl_pinjam' => $request->tgl_pinjam,
        ]);

        // 3. Redirect kembali ke halaman index
        return redirect()->route('admin.peminjamanlaptop.index')
            ->with('success', 'Data laptop berhasil ditambahkan.');

    }



    public function storePeminjamaLaptop() {}
}
