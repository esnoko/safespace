<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - SafeSpace</title>
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
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">Logout</button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 border border-red-300">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <form class="flex items-end gap-4" method="GET" action="{{ route('admin.dashboard') }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 border border-gray-300 rounded px-3 py-2">
                        <option value="">All</option>
                        <option value="pending" {{ request('status')==='pending'?'selected':'' }}>Pending</option>
                        <option value="reviewing" {{ request('status')==='reviewing'?'selected':'' }}>Under Review</option>
                        <option value="investigated" {{ request('status')==='investigated'?'selected':'' }}>Investigated</option>
                        <option value="resolved" {{ request('status')==='resolved'?'selected':'' }}>Resolved</option>
                    </select>
                </div>
                <div>
                    <button class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded">Filter</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reports as $report)
                            <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location='{{ route('admin.reports.show', $report->reference_number) }}'">
                                <td class="px-4 py-3 font-mono text-primary">{{ $report->reference_number }}</td>
                                <td class="px-4 py-3">{{ $report->category_display_name }}</td>
                                <td class="px-4 py-3">{{ $report->status_display_name }}</td>
                                <td class="px-4 py-3">{{ $report->created_at->format('M d, Y g:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">No reports found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $reports->links() }}
            </div>
        </div>
    </main>
</body>
</html>