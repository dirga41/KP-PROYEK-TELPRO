<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_name',
        'tenant_group',
        'area',
        'segment',
        'portfolio',
        'tahun_kontrak',
        'start_date',
        'end_date',
        'status',
        'nilai_kontrak', // <-- PERUBAHAN KUNCI: Tambahkan baris ini

    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
