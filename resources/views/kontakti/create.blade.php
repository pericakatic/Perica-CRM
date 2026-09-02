@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Novi Kontakt</h1>

        <form action="{{ route('kontakti.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Tvrtka</label>
                <select name="tvrtka_id" class="w-full border rounded p-2">
                    <option value="">-- Bez tvrtke --</option>
                    @foreach($tvrtke as $tvrtka)
                        <option value="{{ $tvrtka->id }}">{{ $tvrtka->naziv }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Ime *</label>
                    <input type="text" name="ime" required class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Prezime *</label>
                    <input type="text" name="prezime" required class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Telefon</label>
                <input type="text" name="telefon" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="lead">Lead</option>
                    <option value="kontaktiran">Kontaktiran</option>
                    <option value="kupac">Kupac</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('kontakti.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100">Odustani</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Spremi</button>
            </div>
        </form>
    </div>
@endsection
