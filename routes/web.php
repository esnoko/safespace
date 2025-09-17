<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// School admin login routes
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

// Admin dashboard route (requires authentication)
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth');

// Report Routes
Route::prefix('reports')->group(function () {
    Route::get('/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/store', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/success/{reference}', [ReportController::class, 'success'])->name('reports.success');
    Route::get('/track', [ReportController::class, 'track'])->name('reports.track');
    Route::post('/status', [ReportController::class, 'checkStatus'])->name('reports.status');
    Route::get('/evidence/{reference_number}/{filename}', [ReportController::class, 'serveEvidence'])
        ->name('reports.evidence')
        ->middleware('signed');
});

// TEMP DEBUG ROUTE: List recent reports for troubleshooting
if (app()->environment('local') || config('app.debug')) {
    Route::get('/debug/reports', [\App\Http\Controllers\ReportController::class, 'debugReports']);
}