<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::latest()->paginate(10);
        return view('admin.kendaraans.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraans.create');
    }
    /**
     * Simpan kendaraan baru.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'type_kendaraan' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|unique:kendaraans', // Pastikan unik
            'classification' => 'required|in:dinas,pool', // Hanya boleh 'dinas' atau 'pool'
        ]);
        // 2. Buat data
        Kendaraan::create([
            'type_kendaraan' => $request->type_kendaraan,
            'nomor_polisi' => $request->nomor_polisi,
            'classification' => $request->classification,
            // 'status' otomatis 'available'
        ]);
        // 3. Redirect
        return redirect()->route('admin.kendaraans.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }
    /**
     * Tampilkan form edit.
     */
    public function edit(Kendaraan $kendaraan)
    {
        return view('admin.kendaraans.edit', compact('kendaraan'));
    }
    /**
     * Update data kendaraan.
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        // 1. Validasi
        $request->validate([
            'type_kendaraan' => 'required|string|max:255',
            // Pastikan unik, tapi abaikan data (ID) kendaraan ini sendiri
            'nomor_polisi' => [
                'required',
                'string',
                Rule::unique('kendaraans')->ignore($kendaraan->id),
            ],
            'classification' => 'required|in:dinas,pool',
            'status' => 'required|in:available,in_use,maintenance',
        ]);
        // 2. Update data
        $kendaraan->update($request->all());
        // 3. Redirect
        return redirect()->route('admin.kendaraans.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }
    /**
     * Hapus data kendaraan.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        // 1. Hapus
        $kendaraan->delete();
        // 2. Redirect
        return redirect()->route('admin.kendaraans.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
