<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RkapRealization;
use Illuminate\Support\Facades\DB;

class RkapRealizationSeeder extends Seeder
{
    public function run(): void
    {
        $months = [
            'Januari' => 'Q1', 'Februari' => 'Q1', 'Maret' => 'Q1',
            'April' => 'Q2', 'Mei' => 'Q2', 'Juni' => 'Q2',
            'Juli' => 'Q3', 'Agustus' => 'Q3', 'September' => 'Q3',
            'Oktober' => 'Q4', 'November' => 'Q4', 'Desember' => 'Q4'
        ];

        DB::transaction(function () use ($months) {
            foreach ($months as $monthName => $quarter) {
                RkapRealization::firstOrCreate(
                    ['bulan' => $monthName], // Kunci untuk mencari
                    [                         // Data yang akan dibuat jika tidak ditemukan
                        'periode' => $quarter,
                        'rkap_value' => 0,
                        'project_2025_value' => 0,
                        'rev_co_project_2024_sap_value' => 0,
                        'project_2025_co_value' => 0,
                    ]
                );
            }
        });
    }
}