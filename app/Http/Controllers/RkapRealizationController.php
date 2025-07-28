<?php

namespace App\Http\Controllers;

use App\Exports\RkapExport; // <-- TAMBAHKAN INI
use App\Models\RkapRealization;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // <-- TAMBAHKAN INI


class RkapRealizationController extends Controller
{
    /**
     * [DIHAPUS] Metode store() tidak lagi diperlukan karena tidak ada input data baru.
     */
    // public function store(Request $request) { ... }

    public function show(RkapRealization $rkap)
    {
        return response()->json($rkap);
    }

    public function update(Request $request, RkapRealization $rkap)
    {
        // [MODIFIKASI] Validasi hanya untuk field nilai yang bisa diubah.
        // Nama field (misal: project_2025_value) harus cocok dengan atribut 'name' pada form HTML Anda.
        $validatedData = $request->validate([
            'rkap_value' => 'required|numeric',
            'project_2025_value' => 'required|numeric',
            'rev_co_project_2024_sap_value' => 'required|numeric',
            'project_2025_co_value' => 'required|numeric',
        ]);

        $rkap->update($validatedData);

        return redirect(route('dashboard') . '#rkap')->with('success_rkap', 'Data RKAP berhasil diperbarui.');
    }

    /**
     * [MODIFIKASI] Mengubah fungsi destroy menjadi 'reset'.
     * Metode ini akan mengatur ulang nilai-nilai pada baris data, bukan menghapus baris itu sendiri.
     */
    public function destroy(RkapRealization $rkap)
    {
        $rkap->update([
            'rkap_value' => 0,
            'project_2025_value' => 0,
            'rev_co_project_2024_sap_value' => 0,
            'project_2025_co_value' => 0,
        ]);

        return redirect(route('dashboard') . '#rkap')->with('success_rkap', 'Data RKAP berhasil direset.');
    }

    public function export(Request $request)
    {
        $request->validate([
            'ids' => 'required|string',
        ]);

        $ids = explode(',', $request->input('ids'));

        $monthsOrder = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $rkaps = RkapRealization::whereIn('id', $ids)->get()->sortBy(function ($model) use ($monthsOrder) {
            return array_search($model->bulan, $monthsOrder);
        });

        $fileName = 'rkap_vs_realisasi_' . date('Y-m-d') . '.xlsx';

        // Menggunakan Laravel Excel untuk mengunduh file
        return Excel::download(new RkapExport($rkaps), $fileName);
    }
}
