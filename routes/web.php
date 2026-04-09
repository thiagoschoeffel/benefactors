<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BenefactorController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// Auth
Route::get('/login', [AuthController::class, 'create'])->name('login.create');
Route::post('/login/store', [AuthController::class, 'store'])->name('login.store');
Route::delete('/login/destroy', [AuthController::class, 'destroy'])->name('login.destroy');

// Dashboard
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Benefactors
Route::middleware('auth')->get('/benefactors', [BenefactorController::class, 'index'])->name('benefactor.index');
Route::middleware('auth')->get('/benefactors/find', [BenefactorController::class, 'find'])->name('benefactor.find');
Route::middleware('auth')->get('/benefactors/create', [BenefactorController::class, 'create'])->name('benefactor.create');
Route::middleware('auth')->post('/benefactors/store', [BenefactorController::class, 'store'])->name('benefactor.store');
Route::middleware('auth')->get('/benefactors/{benefactor}/edit', [BenefactorController::class, 'edit'])->name('benefactor.edit');
Route::middleware('auth')->put('/benefactors/{benefactor}/edit', [BenefactorController::class, 'update'])->name('benefactor.update');
Route::middleware('auth')->delete('/benefactors/{benefactor}/destroy', [BenefactorController::class, 'destroy'])->name('benefactor.destroy');
Route::middleware('auth')->get('/benefactors/report', [BenefactorController::class, 'report'])->name('benefactor.report');

// Contributions
Route::middleware('auth')->get('/contributions', [ContributionController::class, 'index'])->name('contribution.index');
Route::middleware('auth')->get('/contributions/create', [ContributionController::class, 'create'])->name('contribution.create');
Route::middleware('auth')->post('/contributions/store', [ContributionController::class, 'store'])->name('contribution.store');
Route::middleware('auth')->get('/contributions/{contribution}/edit', [ContributionController::class, 'edit'])->name('contribution.edit');
Route::middleware('auth')->put('/contributions/{contribution}/edit', [ContributionController::class, 'update'])->name('contribution.update');
Route::middleware('auth')->delete('/contributions/{contribution}/destroy', [ContributionController::class, 'destroy'])->name('contribution.destroy');
Route::middleware('auth')->get('/contributions/report', [ContributionController::class, 'report'])->name('contribution.report');

// Reports
Route::middleware('auth')->get('/reports', function () {
    return Inertia::render('Reports/Index');
});
