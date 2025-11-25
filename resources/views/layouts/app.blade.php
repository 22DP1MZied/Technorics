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
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold">TR</span>
                </div>
                <span class="text-xl font-bold text-gray-900">Technorics</span>
            </a>

            <nav class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-600">Home</a>
                <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-emerald-600">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-700">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>
</body>
</html>
