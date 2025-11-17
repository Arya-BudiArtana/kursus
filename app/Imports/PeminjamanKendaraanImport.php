<?php

namespace App\Imports;

use App\Models\Kendaraan;
use App\Models\User;
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

            $id_user = User::where('nip', $row['nip'])->first();

            if (!$id_user) {
                $this->errors->add('User Not Found', "User dengan NIP {$row['nip']} tidak ditemukan.");
                continue; // Skip baris ini dan lanjut ke baris berikutnya
            }

            $id_kendaraan = Kendaraan::where('nomor_polisi', $row['nomor_polisi'])->first();

            if (!$id_kendaraan) {
                $this->errors->add('Kendaraan Not Found', "Kendaraan dengan Nomor Polisi {$row['nomor_polisi']} tidak ditemukan.");
                continue; // Skip baris ini dan lanjut ke baris berikutnya
            }

            $this->data[] = [
                'id_kendaraan' => $id_kendaraan,
                'tgl_pinjam' => $row['tgl_pinjam'],
                'tgl_kembali' => $row['tgl_kembali'],
                'approval' => 'draft',
                'id_user' => $id_user,
            ];
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
