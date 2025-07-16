<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // <-- PENTING: Pastikan untuk mengimpor Carbon

class Contract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_name',
        'tenant_group',
        'area',
        'segment',
        'portfolio',
        'tahun_kontrak',
        'start_date',
        'end_date',
        'nilai_kontrak',
        // 'status' tidak lagi diperlukan di sini jika Anda menghapusnya dari database
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'nilai_kontrak' => 'float',
    ];

    /**
     * Accessor untuk mendapatkan atribut status kontrak secara dinamis.
     * Logika ini akan dijalankan setiap kali properti 'status' diakses.
     *
     * @return string
     */
    public function getStatusAttribute(): string
    {
        // Jika end_date tidak ada, kembalikan status default untuk menghindari error
        if (!$this->attributes['end_date']) {
            return 'tidak valid';
        }

        // Mengubah end_date menjadi objek Carbon untuk perbandingan
        $endDate = Carbon::parse($this->attributes['end_date']);
        $now = Carbon::now();

        // 1. Cek jika tanggal akhir sudah lewat dari hari ini
        if ($now->startOfDay()->greaterThan($endDate)) {
            return 'berakhir';
        }

        // 2. Cek jika tanggal akhir berada dalam 14 hari dari sekarang (inklusif)
        if ($endDate->diffInDays($now->startOfDay()) <= 14) {
            return 'akan berakhir';
        }

        // 3. Jika tidak, maka kontrak masih aktif
        return 'aktif';
    }
}
