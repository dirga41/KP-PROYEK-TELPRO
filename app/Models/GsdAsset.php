<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GsdAsset extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gsd_assets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_gedung',
        'alamat_gedung',
        'lantai_gedung',
        'luasan_tersedia',
        'customer',
        'luasan_terpakai',
        'luasan_idle',
    ];
}