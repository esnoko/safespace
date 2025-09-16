<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Login - SafeSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Enter Verification Code</h1>

        @if(session('status'))
            <div class="bg-blue-50 border border-blue-200 text-blue-700 rounded p-3 mb-4">{{ session('status') }}</div>
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

        <form action="{{ route('admin.verify.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700">Verification Code (6 digits)</label>
                <input type="text" id="otp" name="otp" maxlength="6" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary tracking-widest text-center" value="{{ old('otp') }}" required autocomplete="one-time-code">
            </div>
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2 rounded-lg transition-colors">
                Verify & Continue
            </button>
        </form>

        <div class="mt-6 text-center">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left mr-1"></i>Cancel and go back</button>
            </form>
        </div>
    </div>
</body>
</html> 