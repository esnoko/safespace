<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - SafeSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">School Admin Login</h1>

        @if(session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded p-3 mb-4">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded p-3 mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">School Email</label>
                <input type="email" id="email" name="email" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="school_code" class="block text-sm font-medium text-gray-700">School Code</label>
                <input type="text" id="school_code" name="school_code" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary" value="{{ old('school_code') }}" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary" required>
            </div>
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2 rounded-lg transition-colors">
                Continue
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('welcome') }}" class="text-sm text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left mr-1"></i>Back to Home</a>
        </div>
    </div>
</body>
</html> 