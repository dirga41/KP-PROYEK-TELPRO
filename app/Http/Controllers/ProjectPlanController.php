<?php

namespace App\Http\Controllers;

use App\Models\ProjectPlan;
use Illuminate\Http\Request;

class ProjectPlanController extends Controller
{
    /**
     * Metode ini tidak digunakan secara langsung karena data ditampilkan di dashboard.
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'estimasi_nilai' => 'required|numeric',
            'update_info' => 'nullable|string',
        ]);

        ProjectPlan::create($validatedData);

        return redirect(route('dashboard') . '#planning')->with('success', 'Rencana proyek baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource as JSON for modal editing.
     */
    public function show(ProjectPlan $projectPlan)
    {
        // Mengembalikan data sebagai JSON
        return response()->json($projectPlan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectPlan $projectPlan)
    {
        // Validasi data yang masuk dari form edit
         $validatedData = $request->validate([
            'project' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'estimasi_nilai' => 'required|numeric',
            'update_info' => 'nullable|string',
        ]);

        // Update record di database
        $projectPlan->update($validatedData);

        // Arahkan kembali ke dashboard dengan fragment #planning
        return redirect(route('dashboard') . '#planning')->with('success', 'Data perencanaan proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectPlan $projectPlan)
    {
        // Hapus data dari database
        $projectPlan->delete();

        // Arahkan kembali ke dashboard dengan fragment #planning
        return redirect(route('dashboard') . '#planning')->with('success', 'Data perencanaan proyek berhasil dihapus.');
    }
}
