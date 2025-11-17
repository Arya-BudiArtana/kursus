<?php

namespace App\Exports;

use App\Models\PeminjamanKendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeminjamanKendaraanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PeminjamanKendaraan::with('user', 'kendaraan')->get();
    }

    public function headings(): array
    {
        return [
            'No', //A1
            'Peminjam', //B1
            'Nama Kendaraan', //C1
            'Nomor Polisi', //D1
            'Tanggal Pinjam', //E1
            'Tanggal Kembali', //F1
            'Status Approval', //G1
        ];
    }

    public function map($peminjaman): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $peminjaman->user->name ?? '-',
            $peminjaman->kendaraan->type_kendaraan ?? '-',
            $peminjaman->kendaraan->nomor_polisi ?? '-',
            $peminjaman->tgl_pinjam ?? '-',
            $peminjaman->tgl_kembali ?? '-',
            ucfirst($peminjaman->approval ?? '-'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
