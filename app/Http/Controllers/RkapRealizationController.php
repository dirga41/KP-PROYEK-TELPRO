<?php

namespace App\Http\Controllers;

use App\Models\RkapRealization;
use Illuminate\Http\Request;

class RkapRealizationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required|string|max:255',
            'periode' => 'required|string|max:10',
            'rkap_value' => 'required|numeric',
            'project_2025_value' => 'required|numeric',
            'rev_co_project_2024_sap_value' => 'required|numeric',
            'project_2025_co_value' => 'required|numeric',
        ]);

        RkapRealization::create($validatedData);

        return redirect(route('dashboard') . '#rkap')->with('success_rkap', 'Data RKAP baru berhasil ditambahkan.');
    }

    public function show(RkapRealization $rkap)
    {
        return response()->json($rkap);
    }

    public function update(Request $request, RkapRealization $rkap)
    {
        $validatedData = $request->validate([
            'bulan' => 'required|string|max:255',
            'periode' => 'required|string|max:10',
            'rkap_value' => 'required|numeric',
            'project_2025_value' => 'required|numeric',
            'rev_co_project_2024_sap_value' => 'required|numeric',
            'project_2025_co_value' => 'required|numeric',
        ]);

        $rkap->update($validatedData);

        return redirect(route('dashboard') . '#rkap')->with('success_rkap', 'Data RKAP berhasil diperbarui.');
    }

    public function destroy(RkapRealization $rkap)
    {
        $rkap->delete();
        return redirect(route('dashboard') . '#rkap')->with('success_rkap', 'Data RKAP berhasil dihapus.');
    }
}
