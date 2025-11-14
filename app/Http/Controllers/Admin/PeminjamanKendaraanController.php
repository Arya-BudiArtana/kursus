<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\PeminjamanKendaraan;
use Illuminate\Http\Request;

class PeminjamanKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_peminjaman_kendaraan = PeminjamanKendaraan::with('user', 'kendaraan')->latest()->paginate(10);

        return view('admin.peminjaman_kendaraan.index', compact('data_peminjaman_kendaraan'));
    }

    public function approvePinjaman($id)
    {
        $data_peminjaman_kendaraan = PeminjamanKendaraan::findOrFail($id);
        $data_peminjaman_kendaraan->update([
            'approval' => 'setuju'
        ]);

        // Opsi 1
        // Kendaraan::where('id', $data_peminjaman_kendaraan->id_kendaraan)->update([
        //     'status' => 'in use'
        // ]);

        // Best Practice! 😊
        Kendaraan::findOrFail($data_peminjaman_kendaraan->id_kendaraan)->update([
            'status' => 'in use'
        ]);

        return redirect()->route('admin.peminjaman-kendaraan.index')
            ->with('success', 'Data peminjaman kendaraan disetujui.');
    }

    public function tolakPinjaman($id)
    {
        $data_peminjaman_kendaraan = PeminjamanKendaraan::findOrFail($id);
        $data_peminjaman_kendaraan->update([
            'approval' => 'tolak'
        ]);

        return redirect()->route('admin.peminjaman-kendaraan.index')
            ->with('success', 'Data peminjaman kendaraan ditolak.');
    }

    public function edit(string $id)
    {
        $data_sebelumnya = PeminjamanKendaraan::findOrFail($id);
        $data_kendaraan = Kendaraan::findOrFail($data_sebelumnya->id_kendaraan);

        return view('admin.peminjaman_kendaraan.edit', compact('data_sebelumnya', 'data_kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasiForm = $request->validate([
            'tgl_kembali' => 'required',
        ]);

        $validasiForm['approval'] = 'dikembalikan';

        PeminjamanKendaraan::findOrFail($id)->update($validasiForm);

        // 3. Redirect kembali ke halaman index
        return redirect()->route('admin.peminjaman-kendaraan.index')
            ->with('success', 'Data peminjaman kendaraan berhasil kembalikan.');
    }
}
