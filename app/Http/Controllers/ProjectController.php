<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Exports\ProjectsExport;      // <-- Impor kelas export
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data proyek dari database, diurutkan dari yang terbaru
        $projects = Project::latest()->get();
        
        // Kirim data proyek ke view 'projects.index'
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan view yang berisi form untuk menambah proyek baru
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'segment' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'no_kontrak' => 'required|string|unique:projects,no_kontrak',
            'tanggal_kontrak' => 'required|date',
            'nilai_kontrak' => 'required|numeric',
            'toc' => 'nullable|date',
            'status_progres' => 'required|in:ongoing,closed,closed adm,not started',
        ]);

        Project::create($validatedData);

        // Arahkan kembali ke dashboard dengan fragment #on-hand
        return redirect(route('dashboard') . '#on-hand')->with('success', 'Proyek baru berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        // Mengembalikan data proyek sebagai JSON
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     * Metode ini tidak lagi digunakan untuk modal, tapi kita biarkan saja.
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
        // Validasi data
        $validatedData = $request->validate([
            'nilai_kontrak' => 'required|numeric',
            'status_progres' => 'required|in:ongoing,closed,closed adm,not started',
        ]);

        $project->update($validatedData);

        // Arahkan kembali ke dashboard dengan fragment #on-hand
        return redirect(route('dashboard') . '#on-hand')->with('success', 'Data proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        // Arahkan kembali ke dashboard dengan fragment #on-hand
        return redirect(route('dashboard') . '#on-hand')->with('success', 'Data proyek berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $request->validate(['ids' => 'required|string']);
        $projectIds = explode(',', $request->input('ids'));
        return Excel::download(new ProjectsExport($projectIds), 'projects_export.xlsx');
    }
}
