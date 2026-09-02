@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Uredi Tvrtku</h1>

        <form action="{{ route('tvrtke.update', $tvrtka) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Naziv tvrtke *</label>
                <input type="text" name="naziv" value="{{ $tvrtka->naziv }}" required class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ $tvrtka->email }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Adresa</label>
                <input type="adresa" name="adresa" value="{{ $tvrtka->adresa }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Telefon</label>
                <input type="text" name="telefon" value="{{ $tvrtka->telefon }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status {{ $tvrtka->status }}</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="prospekt" @selected(old('status', $tvrtka->status) == 'prospekt')>Prospekt</option>
                    <option value="aktivna" @selected(old('status', $tvrtka->status) == 'aktivna')>Aktivna</option>
                    <option value="neaktivna" @selected(old('status', $tvrtka->status) == 'neaktivna')>Neaktivna</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('tvrtke.index') }}" class="px-4 py-2 border rounded">Odustani</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Spremi promjene</button>
            </div>
        </form>
    </div>
@endsection
