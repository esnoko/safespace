<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Status - SafeSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#059669',
                        'primary-dark': '#047857',
                        secondary: '#f0fdf4',
                        accent: '#fef3c7'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <div class="bg-primary text-white p-2 rounded-lg mr-3">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">SafeSpace</h1>
                </div>
                <a href="{{ route('welcome') }}" class="text-primary hover:text-primary-dark font-medium">
                    <i class="fas fa-home mr-2"></i>Back to Home
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <div class="bg-primary text-white p-4 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                <i class="fas fa-clipboard-list text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Report Status</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Here's the current status of your report. We'll keep you updated as we progress.
            </p>
        </div>

        <!-- Report Information Card -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Report Details</h2>
                    <p class="text-gray-600">Reference: <span class="font-mono font-bold text-primary">{{ $report->reference_number }}</span></p>
                </div>
                <div class="mt-4 md:mt-0">
                    @php
                        $statusColors = [
                            'pending' => 'bg-orange-100 text-orange-800 border-orange-200',
                            'reviewing' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'investigated' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'resolved' => 'bg-green-100 text-green-800 border-green-200'
                        ];
                        $statusIcons = [
                            'pending' => 'fa-clock',
                            'reviewing' => 'fa-eye',
                            'investigated' => 'fa-search',
                            'resolved' => 'fa-check-circle'
                        ];
                    @endphp
                    <div class="inline-flex items-center px-4 py-2 rounded-full border {{ $statusColors[$report->status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                        <i class="fas {{ $statusIcons[$report->status] ?? 'fa-question' }} mr-2"></i>
                        <span class="font-semibold">{{ $report->status_display_name }}</span>
                    </div>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Timeline</h3>
                <div class="relative">
                    @php
                        $statuses = ['pending', 'reviewing', 'investigated', 'resolved'];
                        $currentIndex = array_search($report->status, $statuses);
                    @endphp
                    
                    <div class="flex items-center justify-between">
                        @foreach($statuses as $index => $status)
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative">
                                    @if($index <= $currentIndex)
                                        <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">
                                            @if($index == $currentIndex)
                                                <i class="fas {{ $statusIcons[$status] }} text-sm"></i>
                                            @else
                                                <i class="fas fa-check text-sm"></i>
                                            @endif
                                        </div>
                                    @else
                                        <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">
                                            <i class="fas {{ $statusIcons[$status] }} text-sm"></i>
                                        </div>
                                    @endif
                                    
                                    @if($index < count($statuses) - 1)
                                        <div class="absolute top-4 left-8 w-full h-0.5 {{ $index < $currentIndex ? 'bg-primary' : 'bg-gray-200' }}"></div>
                                    @endif
                                </div>
                                <div class="mt-2 text-center">
                                    <div class="text-sm font-medium {{ $index <= $currentIndex ? 'text-primary' : 'text-gray-500' }}">
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </div>
                                    @if($index == 0)
                                        <div class="text-xs text-gray-500">{{ $report->created_at->format('M d, Y') }}</div>
                                    @elseif($index <= $currentIndex && $report->status == 'resolved' && $report->resolved_at)
                                        <div class="text-xs text-gray-500">{{ $report->resolved_at->format('M d, Y') }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Report Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Category</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-tag text-primary mr-2"></i>{{ $report->category_display_name }}
                    </p>
                </div>
                
                @if($report->location)
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Location</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>{{ $report->location }}
                    </p>
                </div>
                @endif
                
                @if($report->incident_date)
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Incident Date</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-calendar text-blue-500 mr-2"></i>
                        {{ $report->incident_date->format('M d, Y') }}
                        @if($report->incident_time)
                            at {{ $report->incident_time->format('g:i A') }}
                        @endif
                    </p>
                </div>
                @endif
                
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Submitted</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-calendar-check text-green-500 mr-2"></i>{{ $report->created_at->format('M d, Y \a\t g:i A') }}
                    </p>
                </div>
                  @if($report->evidence_files && count($report->evidence_files) > 0)
                <div class="md:col-span-2">
                    <h3 class="font-semibold text-gray-900 mb-4">Evidence Submitted</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($report->evidence_files as $file)
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                @if(str_starts_with($file['mime_type'], 'image/'))
                                    <!-- Image Evidence -->
                                    <div class="mb-3">
                                        <img src="{{ route('reports.evidence', ['reference_number' => $report->reference_number, 'filename' => $file['stored_name']]) }}" 
                                             alt="{{ $file['original_name'] }}"
                                             class="w-full h-32 object-cover rounded-lg border border-gray-300 cursor-pointer hover:shadow-lg transition-shadow duration-200"
                                             onclick="openImageModal('{{ route('reports.evidence', ['reference_number' => $report->reference_number, 'filename' => $file['stored_name']]) }}', '{{ $file['original_name'] }}')">
                                    </div>
                                @else
                                    <!-- Non-Image Evidence -->
                                    <div class="mb-3 flex items-center justify-center h-32 bg-gray-100 rounded-lg border border-gray-300">
                                        <div class="text-center">
                                            <i class="fas fa-file-alt text-4xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600">{{ strtoupper(pathinfo($file['original_name'], PATHINFO_EXTENSION)) }} File</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="text-sm">
                                    <p class="font-medium text-gray-900 truncate" title="{{ $file['original_name'] }}">
                                        <i class="fas fa-paperclip text-primary mr-1"></i>
                                        {{ $file['original_name'] }}
                                    </p>
                                    <p class="text-gray-500 mt-1">
                                        {{ number_format($file['size'] / 1024, 1) }} KB
                                    </p>
                                    <a href="{{ route('reports.evidence', ['reference_number' => $report->reference_number, 'filename' => $file['stored_name']]) }}" 
                                       target="_blank"
                                       class="inline-block mt-2 text-primary hover:text-primary-dark text-sm font-medium">
                                        <i class="fas fa-external-link-alt mr-1"></i>View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Current Status Information -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">What's Happening Now</h2>
            
            @if($report->status === 'pending')
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="bg-orange-500 text-white p-2 rounded-lg mr-4 mt-1">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Pending Review</h3>
                            <p class="text-gray-700 mb-4">
                                Your report has been successfully submitted and is in our queue for review. 
                                Our team will begin the initial assessment within 24-48 hours.
                            </p>
                            <div class="text-sm text-gray-600">
                                <p><strong>Next Steps:</strong></p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li>Initial review by our safety team</li>
                                    <li>Categorization and priority assessment</li>
                                    <li>Status update to "Under Review"</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($report->status === 'reviewing')
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="bg-blue-500 text-white p-2 rounded-lg mr-4 mt-1">
                            <i class="fas fa-eye text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Under Review</h3>
                            <p class="text-gray-700 mb-4">
                                Our team is actively reviewing your report. We're assessing the situation and determining 
                                the appropriate next steps to ensure your safety and address the reported incident.
                            </p>
                            <div class="text-sm text-gray-600">
                                <p><strong>Current Activities:</strong></p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li>Detailed review of submitted information</li>
                                    <li>Assessment of urgency and required actions</li>
                                    <li>Preparation for investigation if needed</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($report->status === 'investigated')
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="bg-yellow-500 text-white p-2 rounded-lg mr-4 mt-1">
                            <i class="fas fa-search text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Investigation in Progress</h3>
                            <p class="text-gray-700 mb-4">
                                An investigation is currently underway. Appropriate authorities have been notified and 
                                are working to address the situation while maintaining your anonymity.
                            </p>
                            <div class="text-sm text-gray-600">
                                <p><strong>Investigation Process:</strong></p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li>Coordination with relevant authorities</li>
                                    <li>Gathering additional information as needed</li>
                                    <li>Implementation of safety measures</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($report->status === 'resolved')
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="bg-green-500 text-white p-2 rounded-lg mr-4 mt-1">
                            <i class="fas fa-check-circle text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Resolved</h3>
                            <p class="text-gray-700 mb-4">
                                Your report has been fully addressed. Appropriate actions have been taken to resolve 
                                the situation and implement measures to prevent similar incidents.
                            </p>
                            @if($report->admin_notes)
                                <div class="bg-white border border-green-200 rounded-lg p-4 mt-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Resolution Notes:</h4>
                                    <p class="text-gray-700 text-sm">{{ $report->admin_notes }}</p>
                                </div>
                            @endif
                            @if($report->resolved_at)
                                <div class="text-sm text-gray-600 mt-4">
                                    <p><strong>Resolved on:</strong> {{ $report->resolved_at->format('M d, Y \a\t g:i A') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
            <a href="{{ route('reports.track') }}" 
               class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <i class="fas fa-search mr-3"></i>Track Another Report
            </a>
            
            <a href="{{ route('welcome') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-lg transition-colors duration-200">
                <i class="fas fa-home mr-3"></i>Return to Home
            </a>
            
            <a href="{{ route('reports.create') }}" 
               class="text-primary hover:text-primary-dark font-medium">
                <i class="fas fa-plus mr-2"></i>Submit New Report
            </a>
        </div>

        <!-- Support Information -->
        <div class="text-center">
            <div class="bg-secondary border border-primary/20 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Remember: You're Not Alone</h3>
                <p class="text-gray-700 mb-4">
                    Thank you for trusting us with your report. Your courage in speaking up helps create a safer environment for everyone.
                </p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <span class="bg-white px-3 py-1 rounded-full">Crisis Text Line: Text HOME to 741741</span>
                    <span class="bg-white px-3 py-1 rounded-full">National Suicide Prevention: 988</span>
                    <span class="bg-white px-3 py-1 rounded-full">Teen Helpline: 1-800-852-8336</span>
                </div>
            </div>        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 items-center justify-center p-4" style="display: none;">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()" 
                    class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <div class="absolute bottom-4 left-4 right-4 bg-black bg-opacity-50 text-white p-3 rounded-lg">
                <p id="modalImageName" class="text-center font-medium"></p>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc, imageName) {
            const modal = document.getElementById('imageModal');
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalImageName').textContent = imageName;
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</body>
</html>
