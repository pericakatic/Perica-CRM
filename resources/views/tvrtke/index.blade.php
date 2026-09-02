@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tvrtke</h1>
            <p class="text-xs text-gray-500 mt-1">Upravljanje tvrtkama i njihovim statusima u CRM-u</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="inline-flex rounded-lg bg-gray-100 p-1 border border-gray-200">
                <a href="{{ route('tvrtke.index', ['view' => 'kanban']) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request('view', 'kanban') === 'kanban' ? 'bg-white text-indigo-600 shadow-2xs font-semibold' : 'text-gray-600 hover:text-gray-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V5m6 12V5M3 11h18M3 5h18M3 19h18" />
                    </svg>
                    Kanban
                </a>
                <a href="{{ route('tvrtke.index', ['view' => 'table']) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request('view') === 'table' ? 'bg-white text-indigo-600 shadow-2xs font-semibold' : 'text-gray-600 hover:text-gray-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Lista
                </a>
            </div>

            <a href="{{ route('tvrtke.create') }}"
               class="inline-flex items-center gap-1.5 bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-2xs hover:bg-indigo-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nova Tvrtka
            </a>
        </div>
    </div>

    @if(request('view', 'kanban') === 'kanban')
        {{-- ================= KANBAN PRIKAZ ================= --}}
        @php
            $statusi = [
                'prospekt' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200'],
                'aktivna'  => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200'],
                'neaktivna'    => ['bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'border' => 'border-slate-200'],
            ];

            $grupisaneTvrtke = $tvrtke->groupBy('status');
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-start">
            @foreach($statusi as $statusNaziv => $stil)
                @php
                    $tvrtkeUStatusu = $grupisaneTvrtke->get($statusNaziv, collect());
                @endphp

                <div class="bg-gray-100/80 rounded-xl p-4 border border-gray-200/80 flex flex-col max-h-[calc(100vh-220px)]">
                    <div class="flex items-center justify-between mb-3 px-1">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $stil['bg'] }} {{ $stil['text'] }} border {{ $stil['border'] }}">
                                {{ $statusNaziv }}
                            </span>
                            <span class="text-xs font-medium text-gray-500">({{ $tvrtkeUStatusu->count() }})</span>
                        </div>
                    </div>

                    <div class="space-y-3 overflow-y-auto pr-1">
                        @forelse($tvrtkeUStatusu as $tvrtka)
                            <div class="bg-white rounded-lg p-4 shadow-2xs border border-gray-200 hover:border-gray-300 transition-all">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-gray-900 text-sm">{{ $tvrtka->naziv }}</h3>
                                    <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-medium bg-gray-100 text-gray-600 rounded border border-gray-200">
                                        {{ $tvrtka->kontakti_count }} kontakt/a
                                    </span>
                                </div>

                                <div class="space-y-1 text-xs text-gray-500 mb-4">
                                    @if($tvrtka->email)
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="truncate">{{ $tvrtka->email }}</span>
                                        </div>
                                    @endif

                                    @if($tvrtka->telefon)
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span>{{ $tvrtka->telefon }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                                    <a href="{{ route('tvrtke.edit', $tvrtka->id) }}"
                                       class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-50 border border-indigo-200/60 rounded hover:bg-indigo-100 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                        Uredi
                                    </a>

                                    <form action="{{ route('tvrtke.destroy', $tvrtka->id) }}" method="POST"
                                          onsubmit="return confirm('Sigurno želite obrisati ovu tvrtku?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-rose-700 bg-rose-50 border border-rose-200/60 rounded hover:bg-rose-100 transition-colors cursor-pointer">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Obriši
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center border-2 border-dashed border-gray-200 rounded-lg">
                                <p class="text-xs text-gray-400">Nema tvrtki u ovom statusu.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

    @else
        {{-- ================= TABLIČNI PRIKAZ ================= --}}
        <div class="bg-white rounded-xl shadow-2xs border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-gray-50/80 border-b border-gray-200 text-gray-600 text-xs uppercase tracking-wider font-semibold">
                    <th class="p-3.5">Naziv</th>
                    <th class="p-3.5">Email</th>
                    <th class="p-3.5">Telefon</th>
                    <th class="p-3.5">Status</th>
                    <th class="p-3.5">Broj Kontakata</th>
                    <th class="p-3.5 text-right">Akcije</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                @forelse($tvrtke as $tvrtka)
                    <tr class="hover:bg-gray-50/60 transition-colors">
                        <td class="p-3.5 font-medium text-gray-900">{{ $tvrtka->naziv }}</td>
                        <td class="p-3.5 text-gray-600">{{ $tvrtka->email ?? '-' }}</td>
                        <td class="p-3.5 text-gray-600">{{ $tvrtka->telefon ?? '-' }}</td>
                        <td class="p-3.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                {{ $tvrtka->status }}
                            </span>
                        </td>
                        <td class="p-3.5 text-gray-600">{{ $tvrtka->kontakti_count }}</td>
                        <td class="p-3.5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('tvrtke.edit', $tvrtka->id) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-50 border border-indigo-200/60 rounded-md hover:bg-indigo-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    Uredi
                                </a>

                                <form action="{{ route('tvrtke.destroy', $tvrtka->id) }}" method="POST"
                                      onsubmit="return confirm('Sigurno želite obrisati ovu tvrtku?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-rose-700 bg-rose-50 border border-rose-200/60 rounded-md hover:bg-rose-100 transition-colors cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Obriši
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">Nema unesenih tvrtki.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endif
@endsection
