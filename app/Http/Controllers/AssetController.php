<?php

namespace App\Http\Controllers;

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
    // app/Http/Controllers/AssetController.php

    public function index()
    {
        $assets = Asset::latest()->get();

        // Pastikan variabel ini dihitung
        $totalLandArea = $assets->sum('luas_tanah');
        $totalBuildings = $assets->count();
        $assetNPA = 54; // Placeholder

        // Dan pastikan variabel ini dikirim menggunakan 'compact'
        return view('dashboards.marketing_asset', compact(
            'assets',
            'totalLandArea', // Variabel yang error
            'totalBuildings',
            'assetNPA'
        ));
    }

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

    // public function exportSelected(Request $request)
    // {
    //     // Logika untuk export, mirip dengan ContractController
    // }
}
