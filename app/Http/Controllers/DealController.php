<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Tvrtka;
use App\Models\Kontakt;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function kanban()
    {
        $dealovi = Deal::with('tvrtka')->get();

        return view('dealovi.kanban', compact('dealovi'));
    }

    public function create()
    {
        $tvrtke = Tvrtka::all();
        $kontakti = Kontakt::all();
        return view('dealovi.create', compact('tvrtke', 'kontakti'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tvrtka_id'  => 'required|exists:tvrtke,id',
            'kontakt_id' => 'nullable|exists:kontakti,id',
            'naziv'      => 'required|string|max:255',
            'vrijednost' => 'required|numeric|min:0',
            'status'     => 'required|string',
        ]);

        Deal::create($validated);

        return redirect()->route('dealovi.kanban')->with('success', 'Deal je uspješno kreiran.');
    }

    public function izradiPonudu(Request $request, Deal $deal)
    {
        $brojPonude = 'PON-' . date('Y') . '-' . str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $ponuda = $deal->ponude()->create([
            'broj_ponude'  => $brojPonude,
            'ukupni_iznos' => $request->input('ukupni_iznos', $deal->vrijednost),
            'status'       => 'nacrt',
        ]);

        return redirect()->route('ponude.show', $ponuda->id)
            ->with('success', "Ponuda {$ponuda->broj_ponude} je kreirana!");
    }

    public function updateStatus(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'status' => 'required|in:lead,kvalificiran,ponuda,dobiveno,izgubljeno',
        ]);

        $deal->update(['status' => $validated['status']]);

        return response()->json(['success' => true]);
    }

    public function edit(Deal $deal)
    {
        $tvrtke = Tvrtka::orderBy('naziv')->get();
        $kontakti = Kontakt::with('tvrtka')->orderBy('ime')->get();

        return view('dealovi.edit', compact('deal', 'tvrtke', 'kontakti'));
    }

    public function update(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'naziv' => 'required|string|max:255',
            'tvrtka_id' => 'required|exists:tvrtke,id',
            'kontakt_id' => 'nullable|exists:kontakti,id',
            'vrijednost' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $deal->update($validated);

        return redirect()->route('dealovi.kanban')->with('success', 'Deal uspješno ažuriran.');
    }

    public function destroy(Deal $deal)
    {
        $deal->delete();
        return redirect()->route('dealovi.kanban')->with('success', 'Deal je obrisan.');
    }
}
