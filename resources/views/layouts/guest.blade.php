<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Technorics') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Logo -->
        <div class="mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-2xl">TR</span>
                </div>
                <span class="text-3xl font-bold text-gray-900">Technorics</span>
            </a>
        </div>

        <!-- Content -->
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>

        <!-- Back to Home -->
        <div class="mt-6">
            <a href="{{ route('home') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                ← Back to Home
            </a>
        </div>
    </div>
</body>
</html>
