<?php
// Pastikan untuk meng-import Model
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Laptop; // <-- IMPORT MODEL
use Illuminate\Http\Request; // <-- IMPORT REQUEST

class LaptopController extends Controller
{
    /**
     * Tampilkan daftar semua laptop (Halaman Read).
     */
    public function index()
    {
        $laptops = Laptop::latest()->paginate(10); // Ambil data terbaru, 10 per halaman
        return view('admin.laptops.index', compact('laptops'));
    }
    
    /**
     * Tampilkan form untuk menambah laptop baru (Halaman Create).
     */
    public function create()
    {
        return view('admin.laptops.create');
    }
    /**
     * Simpan data laptop baru dari form (Proses Create).
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'merk' => 'required|string|max:255',
            'spesifikasi' => 'required|string|max:255',
            'tahun_pengadaan' => 'required|integer|min:2000', // Asumsi min tahun 2000
        ]);
        // 2. Buat data baru
        Laptop::create([
            'merk' => $request->merk,
            'spesifikasi' => $request->spesifikasi,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            // 'status' otomatis 'available' (sesuai migrasi)
        ]);
        // 3. Redirect kembali ke halaman index
        return redirect()->route('admin.laptops.index')
            ->with('success', 'Data laptop berhasil ditambahkan.');
    }
    /**
     * (Opsional) Tampilkan detail satu laptop.
     */
    public function show(Laptop $laptop)
    {
        // $laptop adalah data yg otomatis diambil berdasarkan ID di URL
        return view('admin.laptops.show', compact('laptop'));
    }
    /**
     * Tampilkan form untuk mengedit laptop (Halaman Update).
     */
    public function edit(Laptop $laptop)
    {
        // $laptop adalah data yg otomatis diambil berdasarkan ID di URL
        return view('admin.laptops.edit', compact('laptop'));
    }
    /**
     * Simpan perubahan data laptop (Proses Update).
     */
    public function update(Request $request, Laptop $laptop)
    {
        // 1. Validasi data
        $request->validate([
            'merk' => 'required|string|max:255',
            'spesifikasi' => 'required|string|max:255',
            'tahun_pengadaan' => 'required|integer|min:2000',
            'status' => 'required|in:1,2,3' // Validasi status
        ]);
        // 2. Update data
        $laptop->update([
            'merk' => $request->merk,
            'spesifikasi' => $request->spesifikasi,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'status' => $request->status,
        ]);
        // 3. Redirect kembali
        return redirect()->route('admin.laptops.index')
            ->with('success', 'Data laptop berhasil diperbarui.');
    }
    /**
     * Hapus data laptop (Proses Delete).
     */
    public function destroy(Laptop $laptop)
    {
        // 1. Hapus data
        $laptop->delete();
        // 2. Redirect kembali
        return redirect()->route('admin.laptops.index')
            ->with('success', 'Data laptop berhasil dihapus.');
    }
}