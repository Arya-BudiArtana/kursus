<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KendaraanModel;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{


    public function index(){
        $kendaraan = KendaraanModel::latest()->paginate(10);

        return view('admin.kendaraan.index', compact('kendaraan'));
    }
}
