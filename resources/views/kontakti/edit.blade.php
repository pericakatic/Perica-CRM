@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Uredi Kontakt</h1>

        <form action="{{ route('kontakti.update', $kontakt) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Tvrtka</label>
                <select name="tvrtka_id" class="w-full border rounded p-2">
                    <option value="">-- Bez tvrtke --</option>
                    @foreach($tvrtke as $tvrtka)
                        <option value="{{ $tvrtka->id }}" {{ old('tvrtka_id', $kontakt->tvrtka_id) == $tvrtka->id ? 'selected' : '' }}>
                            {{ $tvrtka->naziv }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Ime *</label>
                    <input type="text" name="ime" value="{{ old('ime', $kontakt->ime) }}" required class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Prezime *</label>
                    <input type="text" name="prezime" value="{{ old('prezime', $kontakt->prezime) }}" required class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $kontakt->email) }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Telefon</label>
                <input type="text" name="telefon" value="{{ old('telefon', $kontakt->telefon) }}" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" autocomplete="off" class="w-full border rounded p-2">
                    <option value="lead" @selected(strtolower(old('status', $kontakt->status)) === 'lead')>Lead</option>
                    <option value="kontaktiran" @selected(strtolower(old('status', $kontakt->status)) === 'kontaktiran')>Kontaktiran</option>
                    <option value="kupac" @selected(strtolower(old('status', $kontakt->status)) === 'kupac')>Kupac</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('kontakti.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100">Odustani</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Spremi</button>
            </div>
        </form>
    </div>
@endsection
