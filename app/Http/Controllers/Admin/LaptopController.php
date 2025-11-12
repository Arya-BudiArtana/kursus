<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laptops = Laptop::latest()->paginate(10);
        // $laptops = Laptop::select('id')->get();


        // $laptop->merk;
        // $laptop[0]['merk']

        return view('admin.laptops.index', compact('laptops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laptops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk' => 'required',
            'spesifikasi' => 'required',
            'tahun_pengadaan' => 'required|max:4',
        ]);

        $validated['status'] = 'Tersedia';

        Laptop::create($validated);

        return redirect()->route('admin.laptop.index');
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
        $data = Laptop::findOrFail($id);

        return view('admin.laptops.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'merk' => 'required',
            'spesifikasi' => 'required',
            'tahun_pengadaan' => 'required|max:4',
            'status' => 'required'
        ]);

        Laptop::findOrFail($id)->update($validated);

        return redirect()->route('admin.laptop.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Laptop::findOrFail($id)->delete();

        return redirect()->route('admin.laptop.index');
    }
}
