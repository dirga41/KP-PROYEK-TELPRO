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
        // Jika pengguna memiliki guard 'marketing', arahkan ke dasbor marketing.
        if (Auth::guard('marketing')->check()) {
            return redirect()->route('dashboard.marketing');
        }

        // Jika pengguna memiliki guard 'project', arahkan ke dasbor project.
        if (Auth::guard('project')->check()) {
            return redirect()->route('dashboard.project');
        }

        // Jika tidak ada guard yang cocok, kembalikan ke halaman login.
        return redirect()->route('login')->with('error', 'Tipe akun Anda tidak didukung.');
    }

    /**
     * Menampilkan dasbor untuk Marketing (halaman Kontrak).
     * Rute: /dashboard/marketing
     */
    public function showMarketingDashboard()
    {
        $contracts = Contract::latest()->get();

        return view('dashboards.marketing', [
            'user' => Auth::user(),
            'contracts' => $contracts,
        ]);
    }

    public function showMarketingAssetDashboard()
    {
        // Anda bisa menambahkan logika untuk mengambil data aset di sini nanti.
        return view('dashboards.marketing_asset', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Menampilkan dasbor untuk Project (halaman Monitoring Aset).
     * Rute: /dashboard/project
     */
    public function showProjectDashboard()
    {
        $user = Auth::user();
        $projects = Project::latest()->get();
        $projectPlans = ProjectPlan::latest()->get();
        $rkaps = RkapRealization::orderBy('id')->get();

        // --- LOGIKA DATA YANG DIPERTAHANKAN ---

        // 1. Data RKAP per Kuartal
        $rkapSummary = RkapRealization::select('periode', DB::raw('SUM(rkap_value) as total_rkap'))
            ->groupBy('periode')
            ->get()
            ->pluck('total_rkap', 'periode');

        // 2. Jumlah & Nilai Project
        $projectOnHandCount = $projects->count();
        $projectOnHandValue = $projects->sum('nilai_kontrak');
        $projectPlanningCount = $projectPlans->count();
        $projectPlanningValue = $projectPlans->sum('estimasi_nilai');

        // 3. Status Project per Segment
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

        // 4. Mengirim semua data ke view
        return view('dashboards.project', [
            'user' => $user,
            'projects' => $projects,
            'projectPlans' => $projectPlans,
            'rkaps' => $rkaps,
            // Variabel untuk overview
            'rkapSummary' => $rkapSummary,
            'projectOnHandCount' => $projectOnHandCount,
            'projectOnHandValue' => $projectOnHandValue,
            'projectPlanningCount' => $projectPlanningCount,
            'projectPlanningValue' => $projectPlanningValue,
            'projectStatusBySegment' => $projectStatusBySegment,
        ]);
    }
}
