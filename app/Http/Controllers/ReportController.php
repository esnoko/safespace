<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'is_anonymous' => 'nullable|boolean',
            'category' => 'required|in:bullying,harassment,violence,other',
            'description' => 'required|string|min:10|max:2000',
            'location' => 'nullable|string|max:255',
            'incident_date' => 'nullable|date|before_or_equal:today',
            'incident_time' => 'nullable|date_format:H:i',
            'involved_parties' => 'nullable|string|max:1000',
            'evidence.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,mp4,mp3|max:10240' // 10MB max
        ];

        // Add validation rules for non-anonymous reports
        if (!$request->filled('is_anonymous')) {
            $rules['reporter_name'] = 'required|string|max:255';
            $rules['reporter_email'] = 'required|email|max:255';
            $rules['reporter_phone'] = 'nullable|string|max:20';
            $rules['reporter_grade'] = 'nullable|string|max:50';
            $rules['reporter_student_id'] = 'nullable|string|max:50';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $evidenceFiles = [];
        
        // Handle file uploads
        if ($request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('evidence', $filename, 'private');
                $evidenceFiles[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'stored_name' => $filename,
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ];
            }
        }

        $reportData = [
            'is_anonymous' => $request->filled('is_anonymous'),
            'category' => $request->category,
            'description' => $request->description,
            'location' => $request->location,
            'incident_date' => $request->incident_date,
            'incident_time' => $request->incident_time,
            'involved_parties' => $request->involved_parties,
            'evidence_files' => $evidenceFiles,
        ];

        // Add reporter information if not anonymous
        if (!$request->filled('is_anonymous')) {
            $reportData['reporter_name'] = $request->reporter_name;
            $reportData['reporter_email'] = $request->reporter_email;
            $reportData['reporter_phone'] = $request->reporter_phone;
            $reportData['reporter_grade'] = $request->reporter_grade;
            $reportData['reporter_student_id'] = $request->reporter_student_id;
        }

        $report = Report::create($reportData);

        // Send notification email to admin (you'll need to configure this)
        // Mail::to(config('app.admin_email'))->send(new NewReportNotification($report));

        return redirect()->route('reports.success', ['reference' => $report->reference_number]);
    }

    public function success($reference)
    {
        $report = Report::where('reference_number', $reference)->firstOrFail();
        return view('reports.success', compact('report'));
    }

    public function track()
    {
        return view('reports.track');
    }

    public function checkStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reference_number' => 'required|string|size:12'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $report = Report::where('reference_number', $request->reference_number)->first();

        if (!$report) {
            return back()->withErrors(['reference_number' => 'Report not found. Please check your reference number.'])->withInput();
        }

        return view('reports.status', compact('report'));
    }
}
