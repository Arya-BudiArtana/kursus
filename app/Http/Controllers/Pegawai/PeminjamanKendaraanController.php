<?php

namespace App\Http\Controllers\Pegawai;

use App\Exports\PeminjamanKendaraanExport;
use App\Http\Controllers\Controller;
use App\Imports\PeminjamanKendaraanImport;
use App\Models\Kendaraan;
use App\Models\Laptop;
use App\Models\PeminjamanKendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data_peminjaman_kendaraan = PeminjamanKendaraan::with('user', 'kendaraan')->where('id_user', Auth::id())->latest()->paginate(10);
        return view('pegawai.peminjaman_kendaraan.index');
    }

    public function datatable()
    {
        $query = PeminjamanKendaraan::query();
        $query->with('user', 'kendaraan');
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_kendaraan = Kendaraan::select('id', 'type_kendaraan')->where('status', 'available')->get();

        return view('pegawai.peminjaman_kendaraan.create', compact('data_kendaraan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasiForm = $request->validate([
            'id_kendaraan' => 'required',
            'tgl_pinjam' => 'required'
        ]);

        PeminjamanKendaraan::create([
            'id_kendaraan' => $validasiForm['id_kendaraan'],
            'tgl_pinjam' => $validasiForm['tgl_pinjam'],
            'id_user' => Auth::id(),
            'approval' => 'draft'
        ]);

        // 3. Redirect kembali ke halaman index
        return redirect()->route('pegawai.peminjaman-kendaraan.index')
            ->with('success', 'Data peminjaman kendaraan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data_sebelumnya = PeminjamanKendaraan::findOrFail($id);
        $data_kendaraan = Kendaraan::select('id', 'type_kendaraan')->where('status', 'available')->get();

        return view('pegawai.peminjaman_kendaraan.edit', compact('data_sebelumnya', 'data_kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasiForm = $request->validate([
            'id_kendaraan' => 'required',
            'tgl_pinjam' => 'required'
        ]);

        PeminjamanKendaraan::findOrFail($id)->update($validasiForm);

        // 3. Redirect kembali ke halaman index
        return redirect()->route('pegawai.peminjaman-kendaraan.index')
            ->with('success', 'Data peminjaman kendaraan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PeminjamanKendaraan::findOrFail($id)->update([
            'approval' => 'batal'
        ]);

        return redirect()->route('pegawai.peminjaman-kendaraan.index')
            ->with('success', 'Data peminjaman kendaraan berhasil dibatalkan.');
    }

    public function export()
    {
        ini_set('max_execution_time', 0);
        $filename = 'peminjaman_kendaraan_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new PeminjamanKendaraanExport, $filename);
    }

    public function import(Request $request)
    {
        //
        $request->validate([
            'file_peminjaman_kendaraan' => 'required|mimes:xls,xlsx'
        ]);

        $import = new PeminjamanKendaraanImport();
        Excel::import($import, $request->file('file_peminjaman_kendaraan'));
        $datas = $import->getData();
        $peminjaman_kendaraan = PeminjamanKendaraan::insert($datas);
        // return redirect()->back()->with('success', 'Data berhasil diimport!');
        return redirect()
            ->back()
            ->with('import_errors', $import->getErrors()->all())
            ->with('success', 'Data berhasil diimport!');
    }
}
