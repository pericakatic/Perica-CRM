@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Novi Deal</h1>

        <form action="{{ route('dealovi.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Naziv Deala *</label>
                <input type="text" name="naziv" required placeholder="npr. Redizajn web stranice" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Tvrtka *</label>
                <select name="tvrtka_id" id="tvrtka_select" required class="w-full border rounded p-2">
                    <option value="">-- Odaberi tvrtku --</option>
                    @foreach($tvrtke as $tvrtka)
                        <option value="{{ $tvrtka->id }}">{{ $tvrtka->naziv }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Kontakt osoba</label>
                <select name="kontakt_id" id="kontakt_select" class="w-full border rounded p-2">
                    <option value="">-- Odaberi kontakt --</option>
                    @foreach($kontakti as $kontakt)
                        <option value="{{ $kontakt->id }}" data-tvrtka-id="{{ $kontakt->tvrtka_id }}">
                            {{ $kontakt->ime }} {{ $kontakt->prezime }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Procijenjena Vrijednost (EUR) *</label>
                <input type="number" step="0.01" name="vrijednost" required placeholder="0.00" class="w-full border rounded p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="lead">Lead</option>
                    <option value="kvalificiran">Kvalificiran</option>
                    <option value="ponuda">Ponuda</option>
                    <option value="dobiveno">Dobiveno</option>
                    <option value="izgubljeno">Izgubljeno</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('dealovi.kanban') }}" class="px-4 py-2 border rounded hover:bg-gray-100">Odustani</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Spremi</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tvrtkaSelect = document.getElementById('tvrtka_select');
            const kontaktSelect = document.getElementById('kontakt_select');
            const kontaktOpcije = Array.from(kontaktSelect.querySelectorAll('option'));

            function filtrirajKontakte() {
                const odabranaTvrtkaId = tvrtkaSelect.value;

                kontaktOpcije.forEach(opcija => {
                    if (opcija.value === "") {
                        opcija.hidden = false;
                        return;
                    }

                    if (odabranaTvrtkaId && opcija.getAttribute('data-tvrtka-id') === odabranaTvrtkaId) {
                        opcija.hidden = false;
                    } else {
                        opcija.hidden = true;
                    }
                });

                const trenutnoOdabranaOpcija = kontaktSelect.options[kontaktSelect.selectedIndex];
                if (trenutnoOdabranaOpcija && trenutnoOdabranaOpcija.hidden) {
                    kontaktSelect.value = "";
                }
            }

            tvrtkaSelect.addEventListener('change', filtrirajKontakte);

            filtrirajKontakte();
        });
    </script>
@endsection
