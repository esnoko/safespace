<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submit Report - SafeSpace</title>
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
<body class="bg-gray-100 min-h-screen">
    <!-- Simple Header -->
    <header class="bg-primary text-white py-3">
        <div class="max-w-2xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-lg font-bold">SafeSpace Report</h1>
            <a href="{{ route('welcome') }}" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-home mr-1"></i>Home
            </a>
        </div>
    </header>

    <div class="max-w-2xl mx-auto px-4 py-4"><!-- Report Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Anonymous Choice -->
                <div>
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-user-secret mr-2 text-primary"></i>Reporting Method *
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="is_anonymous" value="1" class="sr-only peer" {{ old('is_anonymous', '1') == '1' ? 'checked' : '' }} onchange="toggleReporterInfo()">
                            <div class="p-6 border-2 border-gray-200 rounded-lg transition-all peer-checked:border-primary peer-checked:bg-secondary hover:border-gray-300">
                                <div class="flex flex-col items-center text-center">
                                    <div class="bg-primary text-white p-3 rounded-full mb-3">
                                        <i class="fas fa-user-secret text-2xl"></i>
                                    </div>
                                    <h3 class="font-bold text-gray-900 mb-2">Anonymous Report</h3>
                                    <p class="text-sm text-gray-600">Your identity will remain completely private</p>
                                    <div class="mt-3 text-xs text-green-600">
                                        <i class="fas fa-check mr-1"></i>100% Anonymous
                                    </div>
                                </div>
                            </div>
                        </label>
                        
                        <label class="relative cursor-pointer">
                            <input type="radio" name="is_anonymous" value="0" class="sr-only peer" {{ old('is_anonymous') == '0' ? 'checked' : '' }} onchange="toggleReporterInfo()">
                            <div class="p-6 border-2 border-gray-200 rounded-lg transition-all peer-checked:border-primary peer-checked:bg-secondary hover:border-gray-300">
                                <div class="flex flex-col items-center text-center">
                                    <div class="bg-blue-500 text-white p-3 rounded-full mb-3">
                                        <i class="fas fa-user text-2xl"></i>
                                    </div>
                                    <h3 class="font-bold text-gray-900 mb-2">Identified Report</h3>
                                    <p class="text-sm text-gray-600">Provide your contact information for follow-up</p>
                                    <div class="mt-3 text-xs text-blue-600">
                                        <i class="fas fa-phone mr-1"></i>Follow-up Available
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('is_anonymous')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reporter Information (shown only for non-anonymous reports) -->
                <div id="reporter-info" class="hidden">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
                        <i class="fas fa-id-card mr-2 text-primary"></i>Your Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="reporter_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name *
                            </label>
                            <input 
                                type="text" 
                                id="reporter_name" 
                                name="reporter_name" 
                                value="{{ old('reporter_name') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="Enter your full name">
                            @error('reporter_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="reporter_email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input 
                                type="email" 
                                id="reporter_email" 
                                name="reporter_email" 
                                value="{{ old('reporter_email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="your.email@example.com">
                            @error('reporter_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="reporter_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input 
                                type="tel" 
                                id="reporter_phone" 
                                name="reporter_phone" 
                                value="{{ old('reporter_phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="(555) 123-4567">
                            @error('reporter_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="reporter_grade" class="block text-sm font-medium text-gray-700 mb-2">
                                Grade/Class
                            </label>
                            <input 
                                type="text" 
                                id="reporter_grade" 
                                name="reporter_grade" 
                                value="{{ old('reporter_grade') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="e.g., Grade 10, Senior Class">
                            @error('reporter_grade')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="reporter_student_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Student ID (if applicable)
                            </label>
                            <input 
                                type="text" 
                                id="reporter_student_id" 
                                name="reporter_student_id" 
                                value="{{ old('reporter_student_id') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="Enter your student ID">
                            @error('reporter_student_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Category Selection -->
                <div>
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-list mr-2 text-primary"></i>Type of Incident *
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $categories = [
                                'bullying' => ['name' => 'Bullying', 'icon' => 'fa-user-slash', 'color' => 'red'],
                                'substance_abuse' => ['name' => 'Substance Abuse', 'icon' => 'fa-pills', 'color' => 'orange'],
                                'sexual_harassment' => ['name' => 'Sexual Harassment', 'icon' => 'fa-hand-paper', 'color' => 'purple'],
                                'weapons' => ['name' => 'Weapons', 'icon' => 'fa-exclamation-triangle', 'color' => 'yellow'],
                                'teenage_pregnancy' => ['name' => 'Teenage Pregnancy', 'icon' => 'fa-heart', 'color' => 'pink'],
                                'other' => ['name' => 'Other', 'icon' => 'fa-ellipsis-h', 'color' => 'gray']
                            ];
                        @endphp
                        
                        @foreach($categories as $key => $category)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="category" value="{{ $key }}" class="sr-only peer" {{ old('category') == $key ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-200 rounded-lg transition-all peer-checked:border-primary peer-checked:bg-secondary hover:border-gray-300">
                                <div class="flex flex-col items-center text-center">
                                    <i class="fas {{ $category['icon'] }} text-2xl text-{{ $category['color'] }}-500 mb-2"></i>
                                    <span class="font-medium text-gray-900">{{ $category['name'] }}</span>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('category')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-comment-alt mr-2 text-primary"></i>Tell us what happened *
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="6" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary resize-none"
                        placeholder="Please describe the incident in detail. Include what happened, when it occurred, and any other relevant information. The more details you provide, the better we can help."
                        required>{{ old('description') }}</textarea>
                    <div class="flex justify-between text-sm text-gray-500 mt-2">
                        <span>Minimum 10 characters required</span>
                        <span id="char-count">0 / 2000</span>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location and Time -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="location" class="block text-lg font-semibold text-gray-900 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>Location
                        </label>
                        <input 
                            type="text" 
                            id="location" 
                            name="location" 
                            value="{{ old('location') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                            placeholder="e.g., School cafeteria, Classroom 201">
                        @error('location')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="incident_date" class="block text-lg font-semibold text-gray-900 mb-2">
                            <i class="fas fa-calendar mr-2 text-primary"></i>Date
                        </label>
                        <input 
                            type="date" 
                            id="incident_date" 
                            name="incident_date" 
                            value="{{ old('incident_date') }}"
                            max="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        @error('incident_date')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="incident_time" class="block text-lg font-semibold text-gray-900 mb-2">
                            <i class="fas fa-clock mr-2 text-primary"></i>Time
                        </label>
                        <input 
                            type="time" 
                            id="incident_time" 
                            name="incident_time" 
                            value="{{ old('incident_time') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        @error('incident_time')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Evidence Upload -->
                <div>
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-paperclip mr-2 text-primary"></i>Evidence (Optional)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-primary transition-colors">
                        <input 
                            type="file" 
                            id="evidence_files" 
                            name="evidence_files[]" 
                            multiple 
                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.mp4,.mp3"
                            class="hidden">
                        <label for="evidence_files" class="cursor-pointer">
                            <div class="space-y-4">
                                <div class="bg-gray-100 text-gray-600 p-4 rounded-full w-16 h-16 mx-auto flex items-center justify-center">
                                    <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-medium text-gray-900">Click to upload files</p>
                                    <p class="text-gray-600">or drag and drop</p>
                                </div>
                                <p class="text-sm text-gray-500">
                                    Images (JPG, PNG), Documents (PDF, DOC), Audio/Video (MP3, MP4)<br>
                                    Maximum file size: 10MB each
                                </p>
                            </div>
                        </label>
                    </div>
                    <div id="file-list" class="mt-4 space-y-2"></div>
                    @error('evidence_files.*')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>                <!-- Submit Button -->
                <div class="flex justify-center pt-6">
                    <button 
                        type="submit" 
                        id="submit-btn"
                        class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-12 rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fas fa-paper-plane mr-3"></i><span id="submit-text">Submit Report Anonymously</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-12 text-center">
            <div class="bg-accent/50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Need Immediate Help?</h3>
                <p class="text-gray-700 mb-4">
                    If you're in immediate danger, please contact emergency services or reach out to a trusted adult.
                </p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <span class="bg-white px-3 py-1 rounded-full">Emergency: 911</span>
                    <span class="bg-white px-3 py-1 rounded-full">Crisis Text Line: Text HOME to 741741</span>
                    <span class="bg-white px-3 py-1 rounded-full">National Suicide Prevention: 988</span>
                </div>
            </div>
        </div>
    </div>    <script>
        // Toggle reporter information visibility
        function toggleReporterInfo() {
            const isAnonymous = document.querySelector('input[name="is_anonymous"]:checked').value === '1';
            const reporterInfo = document.getElementById('reporter-info');
            const submitText = document.getElementById('submit-text');
            
            if (isAnonymous) {
                reporterInfo.classList.add('hidden');
                submitText.textContent = 'Submit Report Anonymously';
                // Clear required attributes for anonymous reports
                document.querySelectorAll('#reporter-info input[required]').forEach(input => {
                    input.removeAttribute('required');
                });
            } else {
                reporterInfo.classList.remove('hidden');
                submitText.textContent = 'Submit Report with Contact Info';
                // Add required attributes for non-anonymous reports
                document.getElementById('reporter_name').setAttribute('required', 'required');
                document.getElementById('reporter_email').setAttribute('required', 'required');
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleReporterInfo();
        });

        // Character counter for description
        const textarea = document.getElementById('description');
        const charCount = document.getElementById('char-count');
        
        function updateCharCount() {
            const count = textarea.value.length;
            charCount.textContent = `${count} / 2000`;
            
            if (count > 2000) {
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
            }
        }
        
        textarea.addEventListener('input', updateCharCount);
        updateCharCount();

        // File upload handling
        const fileInput = document.getElementById('evidence_files');
        const fileList = document.getElementById('file-list');
        
        fileInput.addEventListener('change', function() {
            fileList.innerHTML = '';
            
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between bg-gray-50 p-3 rounded-lg';
                fileItem.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-file text-primary mr-3"></i>
                        <span class="text-sm text-gray-900">${file.name}</span>
                        <span class="text-xs text-gray-500 ml-2">(${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                fileList.appendChild(fileItem);
            }
        });
    </script>
</body>
</html>
