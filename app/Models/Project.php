<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql_project';

    /**
     * The table associated with the model.
     *
     * @var string
     */
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
        'jenis_pengadaan', // <-- Tambahkan ini
        'status_panjar',   // <-- Tambahkan ini
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
    ];
}
