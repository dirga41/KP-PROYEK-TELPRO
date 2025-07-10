<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPlanController;
use App\Http\Controllers\RkapRealizationController;
use App\Http\Controllers\ContractController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware Group untuk semua halaman yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    
    // PERUBAHAN: Rute dasbor yang lebih spesifik
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Rute default
    Route::get('/dashboard/marketing', [DashboardController::class, 'showMarketingDashboard'])->name('dashboard.marketing');
    Route::get('/dashboard/project', [DashboardController::class, 'showProjectDashboard'])->name('dashboard.project');
    Route::get('/dashboard/marketing/asset', [DashboardController::class, 'showMarketingAssetDashboard'])->name('dashboard.marketing.asset');

    // Rute untuk Project
    Route::get('/projects/export', [ProjectController::class, 'export'])->name('projects.export');
    Route::resource('projects', ProjectController::class);

    // Rute untuk Project Plan
    Route::get('/project-plans/export', [ProjectPlanController::class, 'export'])->name('project-plans.export');
    Route::resource('project-plans', ProjectPlanController::class);

    // Rute untuk RKAP
    Route::get('/rkaps/export', [RkapRealizationController::class, 'export'])->name('rkaps.export');
    Route::resource('rkaps', RkapRealizationController::class);

    // Rute untuk Contract
    Route::get('/contracts/export', [ContractController::class, 'exportSelected'])->name('contracts.export');
    Route::resource('contracts', ContractController::class);
});
