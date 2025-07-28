<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPlanController;
use App\Http\Controllers\RkapRealizationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\GsdAssetController; // <-- 1. IMPORT CONTROLLER BARU

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

    // Rute dasbor umum
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute dasbor marketing dan project
    Route::get('/dashboard/marketing', [ContractController::class, 'index'])->name('dashboard.marketing');
    Route::get('/dashboard/project', [DashboardController::class, 'showProjectDashboard'])->name('dashboard.project');
    
    // Rute untuk Dasbor Monitoring Asset
    Route::get('/dashboard/asset', [AssetController::class, 'index'])->name('dashboard.asset');

    // Rute untuk Project
    Route::get('/projects/export', [ProjectController::class, 'export'])->name('projects.export');
    Route::resource('projects', ProjectController::class);

    // Rute untuk Project Plan
    Route::get('/project-plans/export', [ProjectPlanController::class, 'export'])->name('project-plans.export');
    Route::resource('project-plans', ProjectPlanController::class);

    // Rute untuk RKAP
    Route::get('/rkaps/export', [RkapRealizationController::class, 'export'])->name('rkaps.export');
    Route::resource('rkaps', RkapRealizationController::class)->except('store', 'create');

    // Rute untuk Aset Telkom
    Route::resource('assets', AssetController::class);

    // =================================================================
    // BARU: Rute untuk Aset GSD
    // =================================================================
    // Route::resource akan secara otomatis membuat rute untuk:
    // - gsd-assets.index   (GET)
    // - gsd-assets.create  (GET)
    // - gsd-assets.store   (POST)
    // - gsd-assets.show    (GET)
    // - gsd-assets.edit    (GET)
    // - gsd-assets.update  (PUT/PATCH)
    // - gsd-assets.destroy (DELETE)
    Route::resource('gsd-assets', GsdAssetController::class);
    // Anda juga bisa menambahkan rute export jika diperlukan
    Route::get('/gsd-assets/export', [GsdAssetController::class, 'export'])->name('gsd-assets.export');
    // =================================================================

    // Rute untuk redirect dari sidebar
    Route::get('/dashboard/marketing/asset', function () {
        return redirect()->route('dashboard.asset');
    })->name('dashboard.marketing.asset');

    // Rute untuk Kontrak
    Route::get('/contracts/export', [ContractController::class, 'exportSelected'])->name('contracts.export');
    Route::resource('contracts', ContractController::class)->except(['index']);
});