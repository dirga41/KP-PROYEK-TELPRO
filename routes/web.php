<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPlanController;
use App\Http\Controllers\RkapRealizationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\AssetController;


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

    // --- PERUBAHAN KUNCI ---
    // Rute ini sekarang mengarah ke ContractController@index, tempat logika dasbor berada.
    Route::get('/dashboard/marketing', [ContractController::class, 'index'])->name('dashboard.marketing');

    // Rute dasbor lain (jika diperlukan)
    Route::get('/dashboard/project', [DashboardController::class, 'showProjectDashboard'])->name('dashboard.project');

    // Rute untuk Project
    Route::get('/projects/export', [ProjectController::class, 'export'])->name('projects.export');
    Route::resource('projects', ProjectController::class);

    // Rute untuk Project Plan
    Route::get('/project-plans/export', [ProjectPlanController::class, 'export'])->name('project-plans.export');
    Route::resource('project-plans', ProjectPlanController::class);

    // Rute untuk RKAP
    Route::get('/rkaps/export', [RkapRealizationController::class, 'export'])->name('rkaps.export');
    Route::resource('rkaps', RkapRealizationController::class);

    Route::resource('assets', AssetController::class);
    
    // Rute untuk Dasbor Monitoring Asset
    Route::get('/dashboard/asset', [AssetController::class, 'index'])->name('dashboard.asset');


    // Rute untuk redirect dari sidebar
    Route::get('/dashboard/marketing/asset', function () {return redirect()->route('dashboard.asset');})->name('dashboard.marketing.asset');
    // --- PERAPIHAN RUTE KONTRAK ---

    // Route::get('/dashboard/marketing/asset', [ContractController::class, 'asset'])->name('dashboard.marketing.asset');

    // Route::resource() sudah secara otomatis membuat rute untuk index, create, store, show, edit, update, dan destroy.
    // Jadi, kita tidak perlu mendefinisikannya secara manual lagi. Cukup tambahkan rute custom seperti 'export'.
    Route::get('/contracts/export', [ContractController::class, 'exportSelected'])->name('contracts.export');
    Route::resource('contracts', ContractController::class)->except(['index']);
    // Kita tambahkan except(['index']) karena rute index utama sekarang adalah /dashboard/marketing
});
