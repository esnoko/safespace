<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\School;
use App\Models\Report;
use App\Mail\AdminOtpMail;

class SchoolAdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'school_code' => 'required|string|max:10',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $school = School::where('email', $request->email)
            ->where('code', $request->school_code)
            ->first();

        if (!$school || !$school->checkAdminPassword($request->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        // Put school in session (pending OTP)
        session(['admin_school_id' => $school->id, 'admin_otp_verified' => false]);

        // Generate and send OTP (6 digits), valid for 10 minutes
        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        Cache::put('admin_otp_'.$school->id, $otp, now()->addMinutes(10));

        try {
            Mail::to($school->email)->send(new AdminOtpMail($school, $otp));
        } catch (\Throwable $e) {
            // If mail fails, still allow verifying using log/mail catcher setups
        }

        return redirect()->route('admin.verify')->with('status', 'We sent an OTP to your email.');
    }

    public function showVerify(Request $request)
    {
        // Require school in session
        if (!session('admin_school_id')) {
            return redirect()->route('admin.login');
        }
        return view('admin.verify');
    }

    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);
        $schoolId = session('admin_school_id');
        if (!$schoolId) {
            return redirect()->route('admin.login');
        }
        $expected = Cache::get('admin_otp_'.$schoolId);
        if (!$expected || $expected !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired code'])->withInput();
        }

        session(['admin_otp_verified' => true]);
        Cache::forget('admin_otp_'.$schoolId);
        return redirect()->route('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        $schoolId = session('admin_school_id');
        $school = School::findOrFail($schoolId);

        $query = Report::where('school_code', $school->code)->orderBy('created_at', 'desc');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $reports = $query->paginate(10)->withQueryString();

        return view('admin.dashboard', compact('school', 'reports'));
    }

    public function showReport($reference)
    {
        $schoolId = session('admin_school_id');
        $school = School::findOrFail($schoolId);
        $report = Report::where('reference_number', $reference)->firstOrFail();
        if ($report->school_code !== $school->code) {
            abort(403);
        }
        return view('admin.report_show', compact('school', 'report'));
    }

    public function updateReport(Request $request, $reference)
    {
        $schoolId = session('admin_school_id');
        $school = School::findOrFail($schoolId);
        $report = Report::where('reference_number', $reference)->firstOrFail();
        if ($report->school_code !== $school->code) {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|in:pending,reviewing,investigated,resolved',
            'admin_notes' => 'nullable|string|max:5000',
        ]);

        $report->status = $data['status'];
        $report->admin_notes = $data['admin_notes'] ?? null;
        if ($data['status'] === 'resolved' && !$report->resolved_at) {
            $report->resolved_at = now();
        }
        $report->save();

        return redirect()->route('admin.reports.show', ['reference' => $report->reference_number])
            ->with('status', 'Report updated');
    }

    public function logout()
    {
        session()->forget(['admin_school_id', 'admin_otp_verified']);
        return redirect()->route('admin.login')->with('status', 'Logged out');
    }
} 