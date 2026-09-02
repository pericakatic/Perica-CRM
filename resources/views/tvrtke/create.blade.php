@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Nova Tvrtka</h1>

        <form action="{{ route('tvrtke.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Naziv tvrtke *</label>
                <input type="text" name="naziv" required class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
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
                <label class="block text-sm font-medium mb-1">Adresa</label>
                <input type="text" name="adresa" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="prospekt">Prospekt</option>
                    <option value="aktivna">Aktivna</option>
                    <option value="neaktivna">Neaktivna</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('tvrtke.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100">Odustani</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Spremi</button>
            </div>
        </form>
    </div>
@endsection
