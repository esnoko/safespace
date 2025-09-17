<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $schoolCode = Auth::user()->school_code;
        $reports = Report::where('school_code', $schoolCode)->orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('reports', 'schoolCode'));
    }
}