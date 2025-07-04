<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
        // Validasi data yang masuk dari form
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

        // Buat record baru di database menggunakan data yang sudah divalidasi
        Project::create($validatedData);

        // Arahkan kembali ke halaman utama proyek dengan pesan sukses
        return redirect()->route('projects.index')->with('success', 'Proyek baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Tampilkan view form edit dan kirim data proyek yang akan diedit
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validasi data yang masuk dari form edit
        $validatedData = $request->validate([
            'segment' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'no_kontrak' => 'required|string|unique:projects,no_kontrak,' . $project->id,
            'tanggal_kontrak' => 'required|date',
            'nilai_kontrak' => 'required|numeric',
            'toc' => 'nullable|date',
            'status_progres' => 'required|in:ongoing,closed,closed adm,not started',
        ]);

        // Update record di database
        $project->update($validatedData);

        // Arahkan kembali ke halaman utama proyek dengan pesan sukses
        return redirect()->route('projects.index')->with('success', 'Data proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Hapus data proyek dari database
        $project->delete();

        // Arahkan kembali ke halaman utama proyek dengan pesan sukses
        return redirect()->route('projects.index')->with('success', 'Data proyek berhasil dihapus.');
    }
}
