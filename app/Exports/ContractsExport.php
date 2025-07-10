<?php

namespace App\Exports;

use App\Models\Contract;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// PERUBAHAN: Menggunakan FromQuery untuk efisiensi
class ContractsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $ids;

    /**
     * PERUBAHAN: Constructor sekarang menerima sebuah array berisi ID.
     *
     * @param array $ids
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
    * PERUBAHAN: Metode ini membangun query Eloquent.
    * Laravel Excel akan menjalankan query ini secara efisien.
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query()
    {
        return Contract::query()->whereIn('id', $this->ids);
    }

    /**
     * Mendefinisikan header untuk kolom di file Excel.
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Tenant',
            'Grup Tenant',
            'Area',
            'Segment',
            'Portfolio',
            'Tahun Kontrak',
            'Tanggal Awal',
            'Tanggal Akhir',
            'Status',
        ];
    }

    /**
     * Memetakan data dari setiap baris kontrak ke kolom yang sesuai.
     * @param mixed $contract
     * @return array
     */
    public function map($contract): array
    {
        return [
            $contract->id,
            $contract->tenant_name,
            $contract->tenant_group,
            $contract->area,
            $contract->segment,
            $contract->portfolio,
            $contract->tahun_kontrak,
            $contract->start_date->format('d-m-Y'),
            $contract->end_date->format('d-m-Y'),
            ucfirst($contract->status),
        ];
    }
}
