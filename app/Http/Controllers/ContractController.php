<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\ContractsExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class ContractController extends Controller
{
    /**
     * Menampilkan halaman dasbor utama dengan semua data yang diperlukan.
     */
    public function index()
    {
        // --- DATA UNTUK TAB "DATABASE CONTRACT" ---
        $contracts = Contract::latest()->get();

        // --- DATA UNTUK TAB "OVERVIEW" ---

        // 1. Data untuk Chart Revenue Per-Segment
        $totalContracts = $contracts->count();
        $segmentCounts = Contract::select('segment', DB::raw('count(*) as count'))
            ->groupBy('segment')
            ->get();

        $segmentColors = [
            'Telkom' => 'text-orange-500',
            'Enterprise' => 'text-purple-500',
            'Subs & Afiliasi' => 'text-yellow-400',
            'Government' => 'text-green-500',
        ];

        $segmentData = $segmentCounts->map(function ($item) use ($totalContracts, $segmentColors) {
            return [
                'name' => $item->segment,
                'percentage' => ($totalContracts > 0) ? round(($item->count / $totalContracts) * 100) : 0,
                'color' => $segmentColors[$item->segment] ?? 'text-gray-400'
            ];
        });

        // 2. Data untuk Top 10 Revenue Tenant
        $topRevenueTenants = collect();
        if (Schema::hasColumn('contracts', 'nilai_kontrak')) {
            $topRevenueTenants = Contract::select('tenant_name as name', DB::raw('SUM(nilai_kontrak) as value'))
                ->where('nilai_kontrak', '>', 0)
                ->groupBy('tenant_name')
                ->orderByDesc('value')
                ->take(10)
                ->get();
        }

        // 3. Data untuk Top 10 Kontrak yang Akan Berakhir
        $expiringContracts = Contract::all()->filter(function ($contract) {
            return $contract->status === 'akan berakhir';
        })->sortBy('end_date')->take(10);

        return view('dashboards.marketing', compact(
            'contracts',
            'segmentData',
            'topRevenueTenants',
            'expiringContracts'
        ));
    }

    /**
     * Menampilkan halaman monitoring asset.
     */
    public function asset()
    {
        $user = Auth::user();

        // Data dummy untuk kartu ringkasan
        $summaryData = [
            'luas_tanah' => '972',
            'jumlah_gedung' => '194',
            'asset_npa' => '54',
        ];

        // --- PERUBAHAN UTAMA ---
        // Mengambil semua data kontrak individual, diurutkan dari yang terbaru.
        // Variabelnya kita ubah namanya menjadi 'contracts' agar lebih jelas.
        $contractsData = Contract::latest()->get();

        return view('dashboards.marketing_asset', [
            'user' => $user,
            'summary' => $summaryData,
            'contracts' => $contractsData, // Mengirim data kontrak ke view
        ]);
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
            'nilai_kontrak' => 'required|numeric|min:0',
        ]);

        Contract::create($validatedData);

        return redirect(route('dashboard.marketing') . '#contract')->with('success_contract', 'Data kontrak baru berhasil ditambahkan.');
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
            'nilai_kontrak' => 'required|numeric|min:0',
        ]);

        $contract->update($validatedData);

        return redirect(route('dashboard.marketing') . '#contract')->with('success_contract', 'Data kontrak berhasil diperbarui.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect(route('dashboard.marketing') . '#contract')->with('success_contract', 'Data kontrak berhasil dihapus.');
    }

    public function exportSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|string',
        ]);

        $ids = explode(',', $request->query('ids'));

        $sanitizedIds = array_filter(array_map('intval', $ids), fn($id) => $id > 0);

        if (empty($sanitizedIds)) {
            return redirect(route('dashboard.marketing') . '#contract')->with('error_contract', 'Tidak ada data valid yang dipilih untuk diekspor.');
        }

        $fileName = 'contracts_export_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new ContractsExport($sanitizedIds), $fileName);
    }
}
