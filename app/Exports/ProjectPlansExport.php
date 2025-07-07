<?php

namespace App\Exports;

use App\Models\ProjectPlan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProjectPlansExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $planIds;

    public function __construct(array $planIds)
    {
        $this->planIds = $planIds;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        // Mengambil data perencanaan hanya untuk ID yang dipilih
        return ProjectPlan::query()->whereIn('id', $this->planIds);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Mendefinisikan judul kolom di file Excel
        return [
            'ID',
            'Project',
            'User',
            'Lokasi',
            'Estimasi Nilai',
            'Update Info',
            'Dibuat Pada',
        ];
    }

    /**
     * @param ProjectPlan $plan
     * @return array
     */
    public function map($plan): array
    {
        // Memformat setiap baris data
        return [
            $plan->id,
            $plan->project,
            $plan->user,
            $plan->lokasi,
            $plan->estimasi_nilai,
            $plan->update_info,
            $plan->created_at->format('d-m-Y H:i'),
        ];
    }
}
