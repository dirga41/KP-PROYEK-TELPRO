<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RkapRealization extends Model
{
    use HasFactory;

    protected $table = 'rkap_realizations';

    protected $fillable = [
        'bulan',
        'periode',
        'rkap_value',
        'project_2025_value',
        'rev_co_project_2024_sap_value',
        'project_2025_co_value',
    ];
}
