<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report {{ $report->reference_number }} - SafeSpace Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-primary text-white p-2 rounded"><i class="fas fa-school"></i></div>
                <div>
                    <h1 class="font-bold text-xl text-gray-900">{{ $school->name }}</h1>
                    <p class="text-sm text-gray-600">{{ $school->district }}, {{ $school->province }}</p>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-primary hover:text-primary-dark"><i class="fas fa-arrow-left mr-1"></i>Back to Dashboard</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded p-3 mb-6">{{ session('status') }}</div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Report Details</h2>
                    <dl class="divide-y divide-gray-200">
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Reference</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2">{{ $report->reference_number }}</dd>
                        </div>
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Category</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2">{{ $report->category_display_name }}</dd>
                        </div>
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Location</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2">{{ $report->location ?: '—' }}</dd>
                        </div>
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Incident</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2">
                                @if($report->incident_date)
                                    {{ optional($report->incident_date)->format('M d, Y') }}
                                    @if(!empty($report->incident_time))
                                        @php
                                            try { $t=\Carbon\Carbon::createFromFormat('H:i', $report->incident_time)->format('g:i A'); } catch (\Exception $e) { $t=$report->incident_time; }
                                        @endphp
                                        at {{ $t }}
                                    @endif
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                        <div class="py-3">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $report->description }}</dd>
                        </div>
                        @if(!$report->is_anonymous)
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Reporter</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2">
                                {{ $report->reporter_name }}
                                <div class="text-gray-500">{{ $report->reporter_email }} • {{ $report->reporter_phone }}</div>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>

                @if($report->evidence_files && count($report->evidence_files))
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Evidence</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($report->evidence_files as $file)
                            <div class="border border-gray-200 rounded p-4">
                                <div class="font-medium text-gray-900 truncate" title="{{ $file['original_name'] }}">{{ $file['original_name'] }}</div>
                                <div class="text-sm text-gray-500 mt-1">{{ strtoupper(pathinfo($file['original_name'], PATHINFO_EXTENSION)) }} • {{ number_format($file['size']/1024,1) }} KB</div>
                                <a target="_blank" class="inline-block mt-2 text-primary hover:text-primary-dark text-sm font-medium" href="{{ URL::temporarySignedRoute('reports.evidence', now()->addMinutes(30), ['reference_number' => $report->reference_number, 'filename' => $file['stored_name']]) }}">
                                    <i class="fas fa-external-link-alt mr-1"></i>Open
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h2>
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 rounded p-3 mb-4">
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.reports.update', ['reference' => $report->reference_number]) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 w-full border border-gray-300 rounded px-3 py-2">
                                <option value="pending" {{ $report->status==='pending'?'selected':'' }}>Pending Review</option>
                                <option value="reviewing" {{ $report->status==='reviewing'?'selected':'' }}>Under Review</option>
                                <option value="investigated" {{ $report->status==='investigated'?'selected':'' }}>Investigated</option>
                                <option value="resolved" {{ $report->status==='resolved'?'selected':'' }}>Resolved</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Admin Notes</label>
                            <textarea name="admin_notes" rows="6" class="mt-1 w-full border border-gray-300 rounded px-3 py-2">{{ old('admin_notes', $report->admin_notes) }}</textarea>
                        </div>
                        <button class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2 rounded">Save Changes</button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Meta</h2>
                    <div class="text-sm text-gray-600">
                        <div><strong>Submitted:</strong> {{ $report->created_at->format('M d, Y g:i A') }}</div>
                        @if($report->resolved_at)
                        <div class="mt-1"><strong>Resolved:</strong> {{ $report->resolved_at->format('M d, Y g:i A') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html> 