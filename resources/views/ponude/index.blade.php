@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Ponude</h1>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-gray-50 border-b text-gray-600 text-sm">
                <th class="p-3">Broj Ponude</th>
                <th class="p-3">Tvrtka</th>
                <th class="p-3">Vezani Deal</th>
                <th class="p-3">Iznos</th>
                <th class="p-3">Status</th>
                <th class="p-3">Akcija</th>
            </tr>
            </thead>
            <tbody>
            @forelse($ponude as $ponuda)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-semibold">{{ $ponuda->broj_ponude }}</td>
                    <td class="p-3">{{ $ponuda->deal->tvrtka->naziv ?? '-' }}</td>
                    <td class="p-3">{{ $ponuda->deal->naziv ?? '-' }}</td>
                    <td class="p-3 font-bold text-green-600">{{ number_format($ponuda->ukupni_iznos, 2) }} EUR</td>
                    <td class="p-3"><span class="px-2 py-1 bg-gray-100 rounded text-xs uppercase">{{ $ponuda->status }}</span></td>
                    <td class="p-3">
                        <a href="{{ route('ponude.show', $ponuda->id) }}"
                           class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium text-sky-700 bg-sky-50 border border-sky-200/60 rounded-md hover:bg-sky-100 hover:text-sky-800 transition-colors shadow-2xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Prikaži
                        </a>

                        <form action="{{ route('ponude.destroy', $ponuda->id) }}" method="POST" class="inline" onsubmit="return confirm('Sigurno želite obrisati ovu ponudu?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-rose-700 bg-rose-50 border border-rose-200/60 rounded-md hover:bg-rose-100 hover:text-rose-800 transition-colors cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Izbriši
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">Nema kreiranih ponuda. Ponude se stvaraju izravno iz kartice pojedinog Deala.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
