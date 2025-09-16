<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\SchoolAdminController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AdminOtpVerified;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [SchoolAdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [SchoolAdminController::class, 'login'])->name('admin.login.submit');
    Route::get('/verify', [SchoolAdminController::class, 'showVerify'])->name('admin.verify');
    Route::post('/verify', [SchoolAdminController::class, 'verify'])->name('admin.verify.submit');

    Route::middleware([AdminAuth::class, AdminOtpVerified::class])->group(function () {
        Route::get('/dashboard', [SchoolAdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/reports/{reference}', [SchoolAdminController::class, 'showReport'])->name('admin.reports.show');
        Route::post('/reports/{reference}/update', [SchoolAdminController::class, 'updateReport'])->name('admin.reports.update');
        Route::post('/logout', [SchoolAdminController::class, 'logout'])->name('admin.logout');
    });
});

// TEMP DEBUG ROUTE: List recent reports for troubleshooting
if (app()->environment('local') || config('app.debug')) {
    Route::get('/debug/reports', [\App\Http\Controllers\ReportController::class, 'debugReports']);
}
