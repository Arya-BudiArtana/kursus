<?php

namespace App\Imports;

use App\Models\Kendaraan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PeminjamanKendaraanImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    protected $errors;
    protected $data = []; // Deklarasi properti $data

    public function __construct()
    {
        $this->errors = new MessageBag();
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            'Template' => $this,
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            $nip = str_replace("'", "", $row['nip']);
            $id_user = User::where('nip', $nip)->first();

            if (!$id_user) {
                $this->errors->add('User Not Found', "User dengan NIP {$row['nip']} tidak ditemukan.");
                continue; // Skip baris ini dan lanjut ke baris berikutnya
            }

            $id_kendaraan = Kendaraan::where('nomor_polisi', $row['nomor_polisi'])->first();


            if (!$id_kendaraan) {
                $this->errors->add('Kendaraan Not Found', "Kendaraan dengan Nomor Polisi {$row['nomor_polisi']} tidak ditemukan.");
                continue; // Skip baris ini dan lanjut ke baris berikutnya
            }

            $tgl_pinjam = Carbon::parse($row['tgl_pinjam'])->format('Y-m-d');
            $tgl_kembali = Carbon::parse($row['tgl_kembali'])->format('Y-m-d');

            $this->data[] = [
                'id_kendaraan' => $id_kendaraan->id,
                'tgl_pinjam' => $tgl_pinjam,
                'tgl_kembali' => $tgl_kembali,
                'approval' => 'draft',
                'id_user' => $id_user->id,
            ];
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
