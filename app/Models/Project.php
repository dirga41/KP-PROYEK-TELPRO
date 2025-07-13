<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $connection = 'mysql_project';
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'segment',
        'area',
        'project',
        'no_kontrak',
        'tanggal_kontrak',
        'nilai_kontrak',
        'toc',
        'status_progres',
        'jenis_pengadaan',
        'status_panjar',
        'spk_date',
        'leads_date',
        'approval_jib_date',
        'contract_date',
        'procurement_juskeb_date',
        'procurement_rb_date',
        'procurement_juspeng_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_kontrak' => 'date',
        'toc' => 'date',
        'nilai_kontrak' => 'decimal:2',
        'spk_date' => 'date',
        'leads_date' => 'date',
        'approval_jib_date' => 'date',
        'contract_date' => 'date',
        'procurement_juskeb_date' => 'date',
        'procurement_rb_date' => 'date',
        'procurement_juspeng_date' => 'date',
    ];

    /**
     * [FIX] Accessor untuk menentukan tahap CRM terbaru secara dinamis.
     *
     * @return string
     */
    public function getCurrentCrmStageAttribute(): string
    {
        // Daftar tahap diurutkan dari yang paling akhir ke paling awal
        $stages = [
            'procurement_juspeng_date' => 'PROCUREMENT - JUSPENG',
            'procurement_rb_date' => 'PROCUREMENT - RB',
            'procurement_juskeb_date' => 'PROCUREMENT - JUSKEB',
            'contract_date' => 'CONTRACT',
            'approval_jib_date' => 'APPROVAL JIB',
            'leads_date' => 'LEADS',
            'spk_date' => 'SPK',
        ];

        // Cari tahap terakhir yang tanggalnya sudah terisi
        foreach ($stages as $dateField => $stageName) {
            if (!empty($this->attributes[$dateField])) {
                return $stageName; // Kembalikan nama tahap jika tanggalnya ada
            }
        }

        // Jika tidak ada tanggal yang terisi, kembalikan status default
        return 'Belum ada progres';
    }
}
