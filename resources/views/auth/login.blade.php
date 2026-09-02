<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava - Perica CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="max-w-md w-full bg-white rounded-xl shadow-md border border-gray-200 p-8">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Perica CRM</h1>
        <p class="text-xs text-gray-500 mt-1">Prijavite se za pristup CRM-u</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-lg p-3">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Email adresa</label>
            <input type="email" name="email" id="email" value="{{ old('email', 'info@pericacrm.com') }}" required autofocus
                   class="w-full text-sm border-gray-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Zaporka</label>
            <input type="password" name="password" id="password" value="demo123!" required
                   class="w-full text-sm border-gray-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2 cursor-pointer text-gray-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                Zapamti me
            </label>
        </div>

        <button type="submit" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition-colors shadow-sm">
            Prijavi se
        </button>
    </form>
</div>

</body>
</html>
