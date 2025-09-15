<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Submitted - SafeSpace</title>
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
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success Message -->
        <div class="text-center mb-12">
            <div class="bg-green-500 text-white p-6 rounded-full w-24 h-24 mx-auto mb-6 flex items-center justify-center animate-pulse">
                <i class="fas fa-check text-4xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Report Submitted Successfully</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Thank you for trusting us with your report. Your voice matters and we take every report seriously.
            </p>
        </div>

        <!-- Reference Number Card -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8 mb-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Reference Number</h2>
                <div class="bg-secondary border-2 border-primary rounded-lg p-6 mb-6">
                    <div class="text-4xl font-mono font-bold text-primary mb-2" id="reference-number">
                        {{ $report->reference_number }}
                    </div>
                    <button 
                        onclick="copyReference()" 
                        class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm transition-colors duration-200">
                        <i class="fas fa-copy mr-2"></i>Copy Reference Number
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-bookmark text-yellow-500 mr-2"></i>Save This Number
                        </h3>
                        <p class="text-sm text-gray-700">
                            Write down or screenshot your reference number. You'll need it to track your report status.
                        </p>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-search text-blue-500 mr-2"></i>Track Your Report
                        </h3>
                        <p class="text-sm text-gray-700">
                            Use your reference number to check the status of your report at any time.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Details Summary -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Report Summary</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Category</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-tag text-primary mr-2"></i>{{ $report->category_display_name }}
                    </p>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Status</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-clock text-orange-500 mr-2"></i>{{ $report->status_display_name }}
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
                    <h3 class="font-semibold text-gray-900 mb-2">Date & Time</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-calendar text-blue-500 mr-2"></i>
                        {{ $report->incident_date->format('M d, Y') }}
                        @if($report->incident_time)
                            at {{ $report->incident_time->format('g:i A') }}
                        @endif
                    </p>
                </div>
                @endif
                
                <div class="md:col-span-2">
                    <h3 class="font-semibold text-gray-900 mb-2">Submitted</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                        <i class="fas fa-calendar-check text-green-500 mr-2"></i>{{ $report->created_at->format('M d, Y \a\t g:i A') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- What Happens Next -->
        <div class="bg-secondary border border-primary/20 rounded-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">What Happens Next?</h2>
            
            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="bg-primary text-white p-3 rounded-full mr-4 mt-1">
                        <span class="font-bold">1</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Review Process</h3>
                        <p class="text-gray-700">Our team will review your report within 24-48 hours. Your report status will be updated to "Under Review".</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-primary text-white p-3 rounded-full mr-4 mt-1">
                        <span class="font-bold">2</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Investigation</h3>
                        <p class="text-gray-700">If needed, appropriate authorities will be notified and an investigation will begin. Your anonymity will be maintained throughout.</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-primary text-white p-3 rounded-full mr-4 mt-1">
                        <span class="font-bold">3</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Resolution</h3>
                        <p class="text-gray-700">You'll be able to track progress and see when your report has been resolved through our tracking system.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('reports.track') }}" 
               class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <i class="fas fa-search mr-3"></i>Track This Report
            </a>
            
            <a href="{{ route('welcome') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-lg transition-colors duration-200">
                <i class="fas fa-home mr-3"></i>Return to Home
            </a>
            
            <a href="{{ route('reports.create') }}" 
               class="text-primary hover:text-primary-dark font-medium">
                <i class="fas fa-plus mr-2"></i>Submit Another Report
            </a>
        </div>

        <!-- Support Information -->
        <div class="mt-12 text-center">
            <div class="bg-accent/50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Need Additional Support?</h3>
                <p class="text-gray-700 mb-4">
                    Remember, you're not alone. There are people who care and want to help.
                </p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <span class="bg-white px-3 py-1 rounded-full">Crisis Text Line: Text HOME to 741741</span>
                    <span class="bg-white px-3 py-1 rounded-full">National Suicide Prevention: 988</span>
                    <span class="bg-white px-3 py-1 rounded-full">Teen Helpline: 1-800-852-8336</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyReference() {
            const referenceNumber = document.getElementById('reference-number').textContent.trim();
            navigator.clipboard.writeText(referenceNumber).then(function() {
                // Show success message
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
                button.classList.add('bg-green-500');
                button.classList.remove('bg-primary', 'hover:bg-primary-dark');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-500');
                    button.classList.add('bg-primary', 'hover:bg-primary-dark');
                }, 2000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
                alert('Reference number: ' + referenceNumber);
            });
        }
    </script>
</body>
</html>
