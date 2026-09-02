@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <div>
                <h1 class="text-2xl font-bold">Ponuda {{ $ponuda->broj_ponude }}</h1>
                <p class="text-sm text-gray-500">Status: <span class="font-semibold uppercase">{{ $ponuda->status }}</span></p>
            </div>
            <div class="text-right">
                <div class="text-xs text-gray-400">Ukupni Iznos</div>
                <div class="text-2xl font-bold text-green-600">{{ number_format($ponuda->ukupni_iznos, 2) }} EUR</div>
            </div>
        </div>

        <div class="space-y-2 mb-6">
            <div><strong>Tvrtka:</strong> {{ $ponuda->deal?->tvrtka->naziv }}</div>
            <div><strong>Kontakt:</strong> {{ $ponuda->deal?->kontakt ? $ponuda->deal->kontakt->ime . ' ' . $ponuda->deal->kontakt->prezime : '-' }}</div>
            <div><strong>Vezani Deal:</strong> {{ $ponuda->deal?->naziv }}</div>
        </div>

        <div class="border-t pt-4 flex gap-3">
            <a href="{{ route('ponude.index') }}" class="bg-gray-200 px-4 py-2 rounded text-sm hover:bg-gray-300">Natrag na Ponude</a>

            <a href="{{ route('ponude.pdf', $ponuda->id) }}" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Preuzmi PDF
            </a>
        </div>



    </div>
@endsection
