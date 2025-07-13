<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProjectsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $projectIds;

    public function __construct(array $projectIds)
    {
        $this->projectIds = $projectIds;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        // Mengambil data proyek hanya untuk ID yang dipilih, diurutkan dari yang terbaru
        return Project::query()->whereIn('id', $this->projectIds)->latest();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // [FIX] Mendefinisikan judul kolom baru di file Excel
        return [
            'ID',
            'Segment',
            'Project',
            'No Kontrak',
            'Tanggal Kontrak',
            'Nilai Kontrak',
            'Tanggal TOC',
            'Area',
            'Jenis Pengadaan',
            'Status Panjar',
            'Status Progres',
            'Tahap CRM', // Kolom baru
            'SPK Date',
            'LEADS Date',
            'APPROVAL JIB Date',
            'CONTRACT Date',
            'PROCUREMENT - JUSKEB Date',
            'PROCUREMENT - RB Date',
            'PROCUREMENT - JUSPENG Date',
            'Dibuat Pada',
        ];
    }

    /**
     * @param Project $project
     * @return array
     */
    public function map($project): array
    {
        // [FIX] Memformat setiap baris data untuk menyertakan kolom baru
        return [
            $project->id,
            $project->segment,
            $project->project,
            $project->no_kontrak,
            $project->tanggal_kontrak->format('d-m-Y'),
            $project->nilai_kontrak,
            $project->toc ? $project->toc->format('d-m-Y') : '-',
            $project->area,
            $project->jenis_pengadaan,
            $project->status_panjar,
            $project->status_progres,
            $project->current_crm_stage, // Data dari accessor
            $project->spk_date ? $project->spk_date->format('d-m-Y') : '-',
            $project->leads_date ? $project->leads_date->format('d-m-Y') : '-',
            $project->approval_jib_date ? $project->approval_jib_date->format('d-m-Y') : '-',
            $project->contract_date ? $project->contract_date->format('d-m-Y') : '-',
            $project->procurement_juskeb_date ? $project->procurement_juskeb_date->format('d-m-Y') : '-',
            $project->procurement_rb_date ? $project->procurement_rb_date->format('d-m-Y') : '-',
            $project->procurement_juspeng_date ? $project->procurement_juspeng_date->format('d-m-Y') : '-',
            $project->created_at->format('d-m-Y H:i'),
        ];
    }
}
