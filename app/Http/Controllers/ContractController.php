<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Exports\ContractsExport;
use Maatwebsite\Excel\Facades\Excel;

class ContractController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard', ['#contract']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tenant_name' => 'required|string|max:255',
            'tenant_group' => 'nullable|string|max:255',
            'area' => 'required|string|max:255',
            'segment' => 'required|string|max:255',
            'portfolio' => 'required|string|max:255',
            'tahun_kontrak' => 'required|digits:4',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:aktif,akan berakhir,berakhir',
        ]);

        Contract::create($validatedData);

        // PERUBAHAN: Redirect kembali ke dashboard dengan hash #contract 
        // agar tab yang benar tetap aktif setelah input data.
        return redirect(route('dashboard') . '#contract')->with('success_contract', 'Data kontrak baru berhasil ditambahkan.');
    }

    public function show(Contract $contract)
    {
        return response()->json($contract);
    }

    public function update(Request $request, Contract $contract)
    {
        $validatedData = $request->validate([
            'tenant_name' => 'required|string|max:255',
            'tenant_group' => 'nullable|string|max:255',
            'area' => 'required|string|max:255',
            'segment' => 'required|string|max:255',
            'portfolio' => 'required|string|max:255',
            'tahun_kontrak' => 'required|digits:4',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:aktif,akan berakhir,berakhir',
        ]);

        $contract->update($validatedData);

        // PERUBAHAN: Redirect kembali ke dashboard dengan hash #contract 
        // agar tab yang benar tetap aktif setelah update data.
        return redirect(route('dashboard') . '#contract')->with('success_contract', 'Data kontrak berhasil diperbarui.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        
        // PERUBAHAN: Redirect kembali ke dashboard dengan hash #contract 
        // agar tab yang benar tetap aktif setelah hapus data.
        return redirect(route('dashboard') . '#contract')->with('success_contract', 'Data kontrak berhasil dihapus.');
    }

    /**
     * METODE YANG DIPERBARUI: Mengekspor data yang dipilih sebagai file Excel.
     */
    public function exportSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|string',
        ]);

        $ids = explode(',', $request->query('ids'));
        
        // Membersihkan dan memvalidasi array ID
        $sanitizedIds = array_filter(array_map('intval', $ids), fn($id) => $id > 0);

        if (empty($sanitizedIds)) {
            return redirect(route('dashboard') . '#contract')->with('error_contract', 'Tidak ada data valid yang dipilih untuk diekspor.');
        }

        $fileName = 'contracts_export_' . date('Y-m-d_H-i-s') . '.xlsx';

        // PERUBAHAN KUNCI: Langsung kirim array ID ke class export.
        // Class ContractsExport akan menangani query ke database.
        return Excel::download(new ContractsExport($sanitizedIds), $fileName);
    }
}
