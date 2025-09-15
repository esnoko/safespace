<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

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
});
