<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPlanController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route untuk menampilkan halaman login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses data login dari form
Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');

// Route untuk menampilkan dashboard, hanya untuk user yang sudah login
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route untuk proses logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Route untuk CRUD Project ---
// Route ini akan secara otomatis membuat semua URL yang diperlukan untuk ProjectController.

// --- Route BARU untuk Project Planning ---
Route::resource('project-plans', ProjectPlanController::class)->middleware('auth');


Route::get('/projects/export', [ProjectController::class, 'export'])->name('projects.export')->middleware('auth');
// Kita juga melindunginya dengan middleware 'auth' agar hanya bisa diakses setelah login.
Route::resource('projects', ProjectController::class)->middleware('auth');


