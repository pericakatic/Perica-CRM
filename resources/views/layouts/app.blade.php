<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perica CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<nav class="bg-gray-900 text-white p-4 shadow-md mb-6">
    <div class="container mx-auto flex gap-6 items-center">
        <span class="font-bold text-xl text-indigo-400"><a href="{{ route('dealovi.kanban') }}">Perica CRM</a></span>
        <a href="{{ route('dealovi.kanban') }}" class="hover:text-indigo-300">Dealovi</a>
        <a href="{{ route('tvrtke.index') }}" class="hover:text-indigo-300">Tvrtke</a>
        <a href="{{ route('kontakti.index') }}" class="hover:text-indigo-300">Kontakti</a>
        <a href="{{ route('ponude.index') }}" class="hover:text-indigo-300">Ponude</a>

        <div class="flex items-center gap-4">
            - <span class="text-sm font-medium text-gray-100">{{ Auth::user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-medium border border-rose-200 bg-rose-50 px-2.5 py-1.5 rounded-md hover:bg-rose-100 transition-colors">
                    Odjava
                </button>
            </form>
        </div>
    </div>
</nav>

<main class="container mx-auto px-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
