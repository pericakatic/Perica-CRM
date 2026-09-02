@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Kanban Board</h1>
            <p class="text-xs text-gray-500 mt-1">Upravljanje prodajnim prilika i statusima dealova</p>
        </div>
        <a href="{{ route('dealovi.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-lg shadow-sm hover:shadow transition-all text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Novi Deal
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-5 overflow-x-auto pb-6">
        @php
            $kolone = [
                'lead' => [
                    'naziv' => 'Lead-ovi',
                    'border' => 'border-slate-400',
                    'header_bg' => 'bg-slate-100',
                    'badge' => 'bg-slate-200 text-slate-700',
                    'accent' => 'border-l-slate-500',
                    'tag' => 'bg-slate-50 text-slate-600'
                ],
                'kvalificiran' => [
                    'naziv' => 'Kvalificirani',
                    'border' => 'border-blue-400',
                    'header_bg' => 'bg-blue-50/80',
                    'badge' => 'bg-blue-100 text-blue-800',
                    'accent' => 'border-l-blue-500',
                    'tag' => 'bg-blue-50 text-blue-700'
                ],
                'ponuda' => [
                    'naziv' => 'Ponuda Poslana',
                    'border' => 'border-amber-400',
                    'header_bg' => 'bg-amber-50/80',
                    'badge' => 'bg-amber-100 text-amber-800',
                    'accent' => 'border-l-amber-500',
                    'tag' => 'bg-amber-50 text-amber-700'
                ],
                'dobiveno' => [
                    'naziv' => 'Dobiveno',
                    'border' => 'border-emerald-400',
                    'header_bg' => 'bg-emerald-50/80',
                    'badge' => 'bg-emerald-100 text-emerald-800',
                    'accent' => 'border-l-emerald-500',
                    'tag' => 'bg-emerald-50 text-emerald-700'
                ],
                'izgubljeno' => [
                    'naziv' => 'Izgubljeno',
                    'border' => 'border-rose-400',
                    'header_bg' => 'bg-rose-50/80',
                    'badge' => 'bg-rose-100 text-rose-800',
                    'accent' => 'border-l-rose-500',
                    'tag' => 'bg-rose-50 text-rose-700'
                ]
            ];
        @endphp

        @foreach($kolone as $statusKey => $st)
            @php
                $columnDeals = $dealovi->filter(fn($d) => strtolower($d->status) === strtolower($statusKey));
                $totalSuma = $columnDeals->sum('vrijednost');
            @endphp

            <div class="bg-gray-50/70 border border-gray-200 rounded-xl p-3.5 flex flex-col min-w-[270px] shadow-sm">
                <!-- Header Kolone -->
                <div class="mb-3 p-3 rounded-lg border-t-4 {{ $st['border'] }} {{ $st['header_bg'] }} shadow-2xs">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-gray-800 text-sm tracking-wide">{{ $st['naziv'] }}</h2>
                        <span id="badge-{{ $statusKey }}" class="text-xs font-bold px-2.5 py-0.5 rounded-full {{ $st['badge'] }}">
                            {{ $columnDeals->count() }}
                        </span>
                    </div>
                    <div class="text-xs text-gray-600 mt-2 font-semibold flex items-center justify-between border-t border-gray-200/60 pt-1.5">
                        <span class="uppercase tracking-wider text-[10px] text-gray-400">Ukupno:</span>
                        <span class="text-gray-900"><span id="sum-{{ $statusKey }}" data-suma="{{ $totalSuma }}">{{ number_format($totalSuma, 2, ',', '.') }}</span> €</span>
                    </div>
                </div>

                <!-- Droppable Kontejner -->
                <div id="{{ $statusKey }}" class="kanban-column space-y-3 min-h-[520px] flex-1 p-1" data-status="{{ $statusKey }}">
                    @foreach($columnDeals as $deal)
                        <div class="kanban-card bg-white p-4 rounded-lg border border-gray-200 border-l-4 {{ $st['accent'] }} shadow-2xs hover:shadow-md cursor-grab active:cursor-grabbing relative group transition-all duration-200"
                             data-id="{{ $deal->id }}"
                             data-vrijednost="{{ $deal->vrijednost }}">

                            <!-- Akcije -->
                            <div class="absolute top-2.5 right-2.5 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 backdrop-blur-xs pl-2 rounded">
                                <a href="{{ route('dealovi.edit', $deal->id) }}" class="p-1 text-gray-400 hover:text-indigo-600 rounded hover:bg-gray-100 transition-colors" title="Uredi">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('dealovi.destroy', $deal->id) }}" method="POST" onsubmit="return confirm('Sigurno želite obrisati ovaj deal?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 text-gray-400 hover:text-rose-600 rounded hover:bg-gray-100 transition-colors" title="Obriši">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>

                            <!-- Sadržaj Kartice -->
                            <div class="font-semibold text-gray-900 text-sm mb-1.5 pr-12 line-clamp-2 leading-snug">{{ $deal->naziv }}</div>

                            <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-3">
                                <span class="w-5 h-5 rounded-full bg-gray-100 text-gray-600 font-bold text-[10px] flex items-center justify-center border border-gray-200">
                                    {{ strtoupper(substr($deal->tvrtka->naziv ?? 'B', 0, 1)) }}
                                </span>
                                <span class="truncate">{{ $deal->tvrtka->naziv ?? 'Bez tvrtke' }}</span>
                            </div>

                            <form action="{{ route('dealovi.izradi-ponudu', $deal->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-xs bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded py-1">
                                    + Izradi Ponudu
                                </button>
                            </form>

                            <div class="flex justify-between items-center pt-2 border-t border-gray-100 mt-2">
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">
                                    {{ number_format($deal->vrijednost, 2, ',', '.') }} €
                                </span>
                                <span class="text-[10px] text-gray-400 font-mono">#{{ $deal->id }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.kanban-column').forEach(column => {
                new Sortable(column, {
                    group: 'kanban',
                    animation: 200,
                    ghostClass: 'opacity-40',
                    chosenClass: 'scale-[1.02]',
                    dragClass: 'shadow-xl',
                    onEnd: function (evt) {
                        let itemEl = evt.item;
                        let fromColumn = evt.from;
                        let toColumn = evt.to;

                        if (fromColumn === toColumn) return;

                        let targetStatus = toColumn.getAttribute('data-status');
                        let sourceStatus = fromColumn.getAttribute('data-status');
                        let dealId = itemEl.getAttribute('data-id');
                        let dealVal = parseFloat(itemEl.getAttribute('data-vrijednost')) || 0;

                        updateColumnTotals(sourceStatus, targetStatus, dealVal);

                        fetch(`/dealovi/${dealId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ status: targetStatus })
                        })
                            .then(response => {
                                if (!response.ok) throw new Error('Mrežna greška');
                                return response.json();
                            })
                            .then(data => {
                                if (!data.success) {
                                    revertDrag(fromColumn, itemEl, sourceStatus, targetStatus, dealVal);
                                }
                            })
                            .catch(() => {
                                alert('Pogreška pri spremanju statusa! Kartica vraćena.');
                                revertDrag(fromColumn, itemEl, sourceStatus, targetStatus, dealVal);
                            });
                    }
                });
            });

            function updateColumnTotals(fromStatus, toStatus, value) {
                let fromBadge = document.getElementById(`badge-${fromStatus}`);
                let fromSumEl = document.getElementById(`sum-${fromStatus}`);
                let fromSuma = (parseFloat(fromSumEl.getAttribute('data-suma')) || 0) - value;

                fromBadge.textContent = parseInt(fromBadge.textContent) - 1;
                fromSumEl.setAttribute('data-suma', fromSuma);
                fromSumEl.textContent = formatCurrency(fromSuma);

                let toBadge = document.getElementById(`badge-${toStatus}`);
                let toSumEl = document.getElementById(`sum-${toStatus}`);
                let toSuma = (parseFloat(toSumEl.getAttribute('data-suma')) || 0) + value;

                toBadge.textContent = parseInt(toBadge.textContent) + 1;
                toSumEl.setAttribute('data-suma', toSuma);
                toSumEl.textContent = formatCurrency(toSuma);
            }

            function revertDrag(fromColumn, itemEl, sourceStatus, targetStatus, dealVal) {
                fromColumn.appendChild(itemEl);
                updateColumnTotals(targetStatus, sourceStatus, dealVal);
            }

            function formatCurrency(amount) {
                return new Intl.NumberFormat('hr-HR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(amount);
            }
        });
    </script>
@endsection
