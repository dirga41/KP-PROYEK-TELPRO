<?php

namespace App\Http\Controllers;

use App\Models\GsdAsset; 
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// Anda perlu membuat class export ini jika ingin fitur export berjalan
// use App\Exports\AssetsExport; 

class AssetController extends Controller
{
    /**
     * Menampilkan halaman dasbor monitoring asset dengan semua data.
     */
    public function index()
    {
        $assets = Asset::latest()->get();
        $gsd_assets = GsdAsset::latest()->get(); // Data GSD sudah diambil di sini

        // Data ringkasan yang sudah ada
        $totalLandArea = $assets->sum('luas_tanah'); //
        $totalBuildings = $assets->count(); //

        // ==================================================================
        // === MULAI LOGIKA BARU UNTUK MENGHITUNG RASIO NPA PER GEDUNG ===
        // ==================================================================

        // 1. Kelompokkan semua aset GSD berdasarkan nama gedungnya
        $assetsByBuilding = $gsd_assets->groupBy('nama_gedung');

        // 2. Tentukan nama gedung yang ingin dihitung
        $targetBuildings = [
            'Gedung TLT',
            'Gedung Menur Sby',
            'Gedung Kusuma Bangsa'
        ];
        
        $buildingRatios = [];

        // 3. Lakukan iterasi untuk setiap gedung target
        foreach ($targetBuildings as $buildingName) {
            $totalIdle = 0;
            $totalTersedia = 0;
            
            // Cek apakah ada data untuk gedung ini di koleksi yang sudah dikelompokkan
            if ($assetsByBuilding->has($buildingName)) {
                $buildingData = $assetsByBuilding->get($buildingName);
                
                // Jumlahkan luasan idle dan tersedia untuk gedung spesifik ini
                $totalIdle = $buildingData->sum('luasan_idle');
                $totalTersedia = $buildingData->sum('luasan_tersedia');
            }
            
            // 4. Hitung rasio dalam bentuk persentase
            //    Cegah pembagian dengan nol jika luasan tersedia adalah 0
            $ratioPercentage = ($totalTersedia > 0) ? ($totalIdle / $totalTersedia) * 100 : 0;
            
            $buildingRatios[$buildingName] = $ratioPercentage;
        }

        // ==================================================================
        // === AKHIR LOGIKA BARU ===
        // ==================================================================


        // Kirim semua data (termasuk rasio yang baru dihitung) ke view
        return view('dashboards.marketing_asset', [
            'assets' => $assets,
            'totalLandArea' => $totalLandArea,
            'totalBuildings' => $totalBuildings,
            'gsd_assets' => $gsd_assets,
            
            // Variabel rasio yang akan digunakan di content_overview_asset.blade.php
            'rasioGedungTlt' => $buildingRatios['Gedung TLT'] ?? 0,
            'rasioGedungMenurSby' => $buildingRatios['Gedung Menur Sby'] ?? 0,
            'rasioGedungKusumaBangsa' => $buildingRatios['Gedung Kusuma Bangsa'] ?? 0,
        ]);
    }
    
    // ... (Sisa method lainnya seperti store, update, destroy tidak perlu diubah)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'area' => 'required|string|max:255',
            'nama_aset' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'luas_tanah' => 'required|numeric|min:0',
        ]);

        Asset::create($validatedData);

        return redirect(route('dashboard.asset') . '#aset_telkom')->with('success_asset', 'Data aset baru berhasil ditambahkan.');
    }

    public function show(Asset $asset)
    {
        return response()->json($asset);
    }

    public function update(Request $request, Asset $asset)
    {
        $validatedData = $request->validate([
            'area' => 'required|string|max:255',
            'nama_aset' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'luas_tanah' => 'required|numeric|min:0',
        ]);

        $asset->update($validatedData);

        return redirect(route('dashboard.asset') . '#aset_telkom')->with('success_asset', 'Data aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect(route('dashboard.asset') . '#aset_telkom')->with('success_asset', 'Data aset berhasil dihapus.');
    }

}