<?php

namespace App\Exports;

use App\Models\GsdAsset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GsdAssetsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $rowNumber = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengambil semua data dari model GsdAsset untuk diekspor.
        return GsdAsset::all();
    }

    /**
     * Menentukan header untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Gedung',
            'Alamat Gedung',
            'Lantai Gedung',
            'Luasan Tersedia (m²)',
            'Customer',
            'Luasan Terpakai (m²)',
            'Luasan Idle (m²)',
        ];
    }

    /**
     * Memetakan data dari setiap baris.
     *
     * @param mixed $gsdAsset
     * @return array
     */
    public function map($gsdAsset): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $gsdAsset->nama_gedung,
            $gsdAsset->alamat_gedung,
            $gsdAsset->lantai_gedung,
            $gsdAsset->luasan_tersedia,
            $gsdAsset->customer,
            $gsdAsset->luasan_terpakai,
            $gsdAsset->luasan_idle,
        ];
    }

    /**
     * Memberikan style pada sheet Excel.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Memberikan style bold pada baris pertama (header).
            1 => ['font' => ['bold' => true]],
        ];
    }
}