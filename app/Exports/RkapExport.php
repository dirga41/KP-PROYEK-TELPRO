<?php

namespace App\Exports;

use App\Models\RkapRealization;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RkapExport implements FromCollection, WithHeadings, WithMapping
{
    protected $rkaps;

    public function __construct(Collection $rkaps)
    {
        $this->rkaps = $rkaps;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->rkaps;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Membuat header kolom secara dinamis
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;

        return [
            'Bulan',
            'Periode',
            'RKAP',
            "PROJECT $currentYear",
            "REV CO PROJECT $previousYear SAP",
            "PROJECT $currentYear + CO"
        ];
    }

    /**
     * @param RkapRealization $rkap
     * @return array
     */
    public function map($rkap): array
    {
        // Memetakan data dari setiap baris sesuai dengan urutan header
        return [
            $rkap->bulan,
            $rkap->periode,
            $rkap->rkap_value,
            $rkap->project_2025_value,
            $rkap->rev_co_project_2024_sap_value,
            $rkap->project_2025_co_value,
        ];
    }
}