<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Project;
use App\Models\ProjectPlan;
use App\Models\RkapRealization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Mengarahkan pengguna ke dasbor yang sesuai berdasarkan guard mereka.
     * Metode ini sekarang berfungsi sebagai router.
     */
    public function index()
    {
        // ... (kode lainnya tidak berubah)
        if (Auth::guard('marketing')->check()) {
            return redirect()->route('dashboard.marketing');
        }
        if (Auth::guard('project')->check()) {
            return redirect()->route('dashboard.project');
        }
        return redirect()->route('login')->with('error', 'Tipe akun Anda tidak didukung.');
    }

    // ... (showMarketingDashboard & showMarketingAssetDashboard tidak berubah)

    /**
     * Menampilkan dasbor untuk Project (halaman Monitoring Aset).
     * Rute: /dashboard/project
     */
    public function showProjectDashboard()
    {
        $user = Auth::user();
        $projects = Project::latest()->get();
        $projectPlans = ProjectPlan::latest()->get();

        // [MODIFIKASI] Mengambil dan mengurutkan data RKAP berdasarkan urutan bulan yang benar.
        $monthsOrder = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $rkaps = RkapRealization::all()->sortBy(function($model) use ($monthsOrder) {
            return array_search($model->bulan, $monthsOrder);
        });

        // --- LOGIKA DATA YANG DIPERTAHANKAN ---

        // 1. Data RKAP per Kuartal
        $rkapSummary = RkapRealization::select('periode', DB::raw('SUM(rkap_value) as total_rkap'))
            ->groupBy('periode')
            ->get()
            ->pluck('total_rkap', 'periode');

        // ... (sisa kode tidak berubah)
        $projectOnHandCount = $projects->count();
        $projectOnHandValue = $projects->sum('nilai_kontrak');
        $projectPlanningCount = $projectPlans->count();
        $projectPlanningValue = $projectPlans->sum('estimasi_nilai');

        $statusCounts = Project::select('segment', 'status_progres', DB::raw('count(*) as total'))
            ->where('status_progres', '!=', 'tech meeting')
            ->groupBy('segment', 'status_progres')
            ->get();

        $projectStatusBySegment = [];
        $segments = $statusCounts->pluck('segment')->unique()->values();
        $statuses = ['ongoing', 'closed', 'closed adm', 'not started'];

        foreach ($segments as $segment) {
            foreach ($statuses as $status) {
                $projectStatusBySegment[$segment][$status] = 0;
            }
        }
        foreach ($statusCounts as $count) {
            if (isset($projectStatusBySegment[$count->segment][$count->status_progres])) {
                $projectStatusBySegment[$count->segment][$count->status_progres] = $count->total;
            }
        }

        return view('dashboards.project', [
            'user' => $user,
            'projects' => $projects,
            'projectPlans' => $projectPlans,
            'rkaps' => $rkaps,
            'rkapSummary' => $rkapSummary,
            'projectOnHandCount' => $projectOnHandCount,
            'projectOnHandValue' => $projectOnHandValue,
            'projectPlanningCount' => $projectPlanningCount,
            'projectPlanningValue' => $projectPlanningValue,
            'projectStatusBySegment' => $projectStatusBySegment,
        ]);
    }
}