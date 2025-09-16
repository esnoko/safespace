<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track Report - SafeSpace</title>
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
                <i class="fas fa-search text-3xl"></i>
            </div>            <h1 class="text-4xl font-bold text-gray-900 mb-4">Track Your Report</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Enter your case number to check the current status of your report.
            </p>
        </div>

        <!-- Privacy Notice -->
        <div class="bg-secondary border border-primary/20 rounded-lg p-6 mb-8">
            <div class="flex items-start">
                <div class="bg-primary text-white p-2 rounded-lg mr-4 mt-1">
                    <i class="fas fa-shield-alt text-lg"></i>
                </div>
                <div>                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Your Privacy Remains Protected</h3>
                    <p class="text-gray-700">
                        Only the case number you were given can access your report details. 
                        No personal information is displayed or stored in our tracking system.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tracking Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
            <form action="{{ route('reports.status') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>                    <label for="reference_number" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-hashtag mr-2 text-primary"></i>Case Number
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="reference_number" 
                            name="reference_number" 
                            value="{{ old('reference_number') }}"
                            class="w-full px-4 py-4 text-lg font-mono border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-center tracking-wider"
                            placeholder="SS########YY"
                            maxlength="12"
                            required
                            autocomplete="off">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                    </div>                    <p class="text-sm text-gray-500 mt-2">
                        Enter the 12-character case number you received when you submitted your report.
                    </p>
                    @error('reference_number')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button 
                        type="submit" 
                        class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-12 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fas fa-search mr-3"></i>Check Status
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Help & Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Reference Number Format -->
                <div>                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>Case Number Format
                    </h3>
                    <div class="space-y-3">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-lg font-mono text-center mb-2">SS + 8 letters + 2 digits</div>
                            <div class="text-sm text-gray-600 text-center">Example: SSABC12345YZ</div>
                        </div>
                        <p class="text-sm text-gray-700">
                            Your reference number always starts with "SS" followed by 8 random characters and ends with 2 digits representing the year.
                        </p>
                    </div>
                </div>

                <!-- Status Meanings -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-list-ul text-green-500 mr-2"></i>Status Meanings
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-orange-400 rounded-full mr-3"></div>
                            <div>
                                <span class="font-medium">Pending Review:</span>
                                <span class="text-sm text-gray-600">Report submitted, waiting for initial review</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-400 rounded-full mr-3"></div>
                            <div>
                                <span class="font-medium">Under Review:</span>
                                <span class="text-sm text-gray-600">Report is being actively reviewed</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-400 rounded-full mr-3"></div>
                            <div>
                                <span class="font-medium">Investigated:</span>
                                <span class="text-sm text-gray-600">Investigation in progress</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-400 rounded-full mr-3"></div>
                            <div>
                                <span class="font-medium">Resolved:</span>
                                <span class="text-sm text-gray-600">Report has been fully addressed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-question-circle text-purple-500 mr-2"></i>Frequently Asked Questions
                </h3>
                
                <div class="space-y-4">
                    <details class="bg-gray-50 p-4 rounded-lg">
                        <summary class="font-medium text-gray-900 cursor-pointer">How long does it take to process a report?</summary>
                        <p class="text-gray-700 mt-2 text-sm">
                            Most reports receive an initial review within 24-48 hours. Complex cases requiring investigation may take longer, 
                            but you can always check your status here.
                        </p>
                    </details>
                    
                    <details class="bg-gray-50 p-4 rounded-lg">
                        <summary class="font-medium text-gray-900 cursor-pointer">I lost my reference number. What can I do?</summary>
                        <p class="text-gray-700 mt-2 text-sm">
                            Unfortunately, we cannot retrieve reference numbers for privacy reasons. If you need to provide additional information 
                            about the same incident, you can submit a new report and mention that it's related to a previous submission.
                        </p>
                    </details>
                    
                    <details class="bg-gray-50 p-4 rounded-lg">
                        <summary class="font-medium text-gray-900 cursor-pointer">Can I add more information to my existing report?</summary>
                        <p class="text-gray-700 mt-2 text-sm">
                            Currently, you cannot edit submitted reports. If you have additional information, you can submit a new report 
                            and reference your original report number in the description.
                        </p>
                    </details>
                    
                    <details class="bg-gray-50 p-4 rounded-lg">
                        <summary class="font-medium text-gray-900 cursor-pointer">Is my anonymity guaranteed?</summary>
                        <p class="text-gray-700 mt-2 text-sm">
                            Yes, absolutely. We do not collect any personal information, IP addresses, or other identifying data. 
                            Only your reference number can access your report details.
                        </p>
                    </details>
                </div>
            </div>
        </div>

        <!-- Additional Actions -->
        <div class="mt-12 text-center">
            <div class="space-y-4">
                <p class="text-gray-600">Need to submit a new report?</p>
                <a href="{{ route('reports.create') }}" 
                   class="inline-block bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-plus mr-3"></i>Submit New Report
                </a>
            </div>
        </div>

        <!-- Crisis Support -->
        <div class="mt-12 text-center">
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">In Crisis? Get Immediate Help</h3>
                <p class="text-gray-700 mb-4">
                    If you're in immediate danger or having thoughts of self-harm, please reach out for help right away.
                </p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="tel:911" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-phone mr-2"></i>Emergency: 911
                    </a>
                    <a href="sms:741741?body=HOME" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                        <i class="fas fa-sms mr-2"></i>Crisis Text: 741741
                    </a>
                    <a href="tel:988" class="bg-purple-500 text-white px-4 py-2 rounded-full hover:bg-purple-600 transition-colors">
                        <i class="fas fa-phone mr-2"></i>Suicide Prevention: 988
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Format reference number input
        const referenceInput = document.getElementById('reference_number');
        
        referenceInput.addEventListener('input', function() {
            // Convert to uppercase and remove any non-alphanumeric characters
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            
            // Limit to 12 characters
            if (this.value.length > 12) {
                this.value = this.value.slice(0, 12);
            }
        });
        
        // Auto-focus on the input field
        referenceInput.focus();
    </script>
</body>
</html>
