<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPlan;
use App\Models\RkapRealization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the correct dashboard based on the user's guard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $activeGuard = null;

        foreach (['marketing', 'project', 'web'] as $guard) {
            if (Auth::guard($guard)->check()) {
                $activeGuard = $guard;
                break;
            }
        }
        
        $loginType = $activeGuard ?? 'unknown';

        if ($loginType === 'project') {
            // --- DATA UNTUK TAB LAIN ---
            $projects = Project::latest()->get();
            $projectPlans = ProjectPlan::latest()->get();
            $rkaps = RkapRealization::orderBy('id')->get();

            // --- PERSIAPAN DATA BARU UNTUK TAB OVERVIEW ---

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
                ->where('status_progres', '!=', 'tech meeting') // Sesuai permintaan
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
                if(isset($projectStatusBySegment[$count->segment][$count->status_progres])) {
                    $projectStatusBySegment[$count->segment][$count->status_progres] = $count->total;
                }
            }
            
            // Mengirim semua data ke view
            return view('dashboards.project', [
                'user' => $user,
                'projects' => $projects,
                'projectPlans' => $projectPlans,
                'rkaps' => $rkaps,
                // Variabel baru untuk overview
                'rkapSummary' => $rkapSummary,
                'projectOnHandCount' => $projectOnHandCount,
                'projectOnHandValue' => $projectOnHandValue,
                'projectPlanningCount' => $projectPlanningCount,
                'projectPlanningValue' => $projectPlanningValue,
                'projectStatusBySegment' => $projectStatusBySegment,
            ]);
        } 
        
        if ($loginType === 'marketing') {
            return view('dashboards.marketing', ['user' => $user]);
        }

        return abort(403, 'Tipe akun tidak valid.');
    }
}
