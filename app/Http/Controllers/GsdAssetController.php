<?php

namespace App\Http\Controllers;

use App\Models\GsdAsset;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// Anda perlu membuat class Export ini agar fitur export berjalan
// Jalankan: php artisan make:export GsdAssetsExport --model=GsdAsset
use App\Exports\GsdAssetsExport;

class GsdAssetController extends Controller
{
    /**
     * Menampilkan daftar resource.
     * Karena tampilan utama ada di dasbor, method ini bisa kita arahkan ke sana.
     */
    public function index()
    {
        return redirect(route('dashboard.asset') . '#aset_gsd');
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     * Tidak digunakan karena kita menggunakan modal, bukan halaman terpisah.
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan resource yang baru dibuat ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form modal input
        $validatedData = $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'alamat_gedung' => 'required|string|max:255',
            'lantai_gedung' => 'required|string|max:255',
            'luasan_tersedia' => 'required|numeric|min:0',
            'customer' => 'nullable|string|max:255',
            'luasan_terpakai' => 'required|numeric|min:0',
            'luasan_idle' => 'required|numeric|min:0',
        ]);

        // Buat data baru di database
        GsdAsset::create($validatedData);

        // Redirect kembali ke dasbor tab GSD dengan pesan sukses
        return redirect(route('dashboard.asset') . '#aset_gsd')
            ->with('success_gsd_asset', 'Data aset GSD baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan resource spesifik dalam format JSON untuk modal edit.
     *
     * @param  \App\Models\GsdAsset  $gsdAsset
     * @return \Illuminate\Http\Response
     */
    public function show(GsdAsset $gsdAsset)
    {
        // Mengembalikan data sebagai JSON yang akan diambil oleh JavaScript
        return response()->json($gsdAsset);
    }

    /**
     * Menampilkan form untuk mengedit resource.
     * Tidak digunakan karena kita menggunakan modal.
     */
    public function edit(GsdAsset $gsdAsset)
    {
        //
    }

    /**
     * Memperbarui resource spesifik di dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GsdAsset  $gsdAsset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GsdAsset $gsdAsset)
    {
        // Validasi data yang masuk dari form modal edit
        $validatedData = $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'alamat_gedung' => 'required|string|max:255',
            'lantai_gedung' => 'required|string|max:255',
            'luasan_tersedia' => 'required|numeric|min:0',
            'customer' => 'nullable|string|max:255',
            'luasan_terpakai' => 'required|numeric|min:0',
            'luasan_idle' => 'required|numeric|min:0',
        ]);

        // Update data di database
        $gsdAsset->update($validatedData);

        // Redirect kembali ke dasbor tab GSD dengan pesan sukses
        return redirect(route('dashboard.asset') . '#aset_gsd')
            ->with('success_gsd_asset', 'Data aset GSD berhasil diperbarui.');
    }

    /**
     * Menghapus resource spesifik dari database.
     *
     * @param  \App\Models\GsdAsset  $gsdAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy(GsdAsset $gsdAsset)
    {
        // Hapus data dari database
        $gsdAsset->delete();

        // Redirect kembali ke dasbor tab GSD dengan pesan sukses
        return redirect(route('dashboard.asset') . '#aset_gsd')
            ->with('success_gsd_asset', 'Data aset GSD berhasil dihapus.');
    }

    /**
     * Mengekspor data ke file Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        // Pastikan Anda sudah membuat class GsdAssetsExport
        return Excel::download(new GsdAssetsExport, 'data-aset-gsd.xlsx');
    }
}