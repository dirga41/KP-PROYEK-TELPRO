<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Exports\ProjectsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menambahkan semua field baru ke validasi store
        $validatedData = $request->validate([
            'segment' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'no_kontrak' => 'required|string|unique:projects,no_kontrak',
            'tanggal_kontrak' => 'required|date',
            'nilai_kontrak' => 'required|numeric',
            'toc' => 'nullable|date',
            'status_progres' => 'required|in:ongoing,closed,closed adm,not started',
            'jenis_pengadaan' => 'nullable|string|in:mitra,swakelola',
            'status_panjar' => 'nullable|string|in:belum drop,mitra,sudah drop',
            // --- Validasi untuk tanggal timeline ---
            'spk_date' => 'nullable|date',
            'leads_date' => 'nullable|date',
            'approval_jib_date' => 'nullable|date',
            'contract_date' => 'nullable|date',
            'procurement_juskeb_date' => 'nullable|date',
            'procurement_rb_date' => 'nullable|date',
            'procurement_juspeng_date' => 'nullable|date',
        ]);

        Project::create($validatedData);

        return redirect(route('dashboard') . '#on-hand')->with('success', 'Proyek baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * Metode ini sudah benar, akan mengembalikan semua data termasuk kolom baru dalam format JSON.
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // --- PERBARUI VALIDASI DI FUNGSI UPDATE ---
        $validatedData = $request->validate([
            'nilai_kontrak' => 'required|numeric',
            'status_progres' => 'required|in:ongoing,closed,closed adm,not started',
            'jenis_pengadaan' => 'nullable|string|in:mitra,swakelola',
            'status_panjar' => 'nullable|string|in:belum drop,mitra,sudah drop',
            // --- Tambahkan validasi untuk semua field baru di sini ---
            'toc' => 'nullable|date',
            'spk_date' => 'nullable|date',
            'leads_date' => 'nullable|date',
            'approval_jib_date' => 'nullable|date',
            'contract_date' => 'nullable|date',
            'procurement_juskeb_date' => 'nullable|date',
            'procurement_rb_date' => 'nullable|date',
            'procurement_juspeng_date' => 'nullable|date',
        ]);

        $project->update($validatedData);

        return redirect(route('dashboard') . '#on-hand')->with('success', 'Data proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect(route('dashboard') . '#on-hand')->with('success', 'Data proyek berhasil dihapus.');
    }

    /**
     * Export selected resources to Excel.
     */
    public function export(Request $request)
    {
        $request->validate(['ids' => 'required|string']);
        $projectIds = explode(',', $request->input('ids'));
        return Excel::download(new ProjectsExport($projectIds), 'projects_export.xlsx');
    }
}
