<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPlan;
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
            // Ambil data untuk kedua tabel
            $projects = Project::latest()->get();
            $projectPlans = ProjectPlan::latest()->get();

            // Memuat view khusus untuk project dan mengirimkan data proyek
            return view('dashboards.project', [
                'user' => $user,
                'projects' => $projects,
                'projectPlans' => $projectPlans,
            ]);
        } 
        
        if ($loginType === 'marketing') {
            // Logika untuk dashboard marketing (jika diperlukan)
            return view('dashboards.marketing', ['user' => $user]);
        }

        return abort(403, 'Tipe akun tidak valid.');
    }
}
