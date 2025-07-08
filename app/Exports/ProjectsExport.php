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
        // Mendefinisikan judul kolom di file Excel
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
            'Dibuat Pada',
        ];
    }

    /**
     * @param Project $project
     * @return array
     */
    public function map($project): array
    {
        // Memformat setiap baris data
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
            $project->created_at->format('d-m-Y H:i'),
        ];
    }
}
