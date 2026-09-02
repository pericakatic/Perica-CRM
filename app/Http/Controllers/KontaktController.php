<?php

namespace App\Http\Controllers;

use App\Models\Kontakt;
use App\Models\Tvrtka;
use Illuminate\Http\Request;

class KontaktController extends Controller
{
    public function index()
    {
        $kontakti = Kontakt::with('tvrtka')->get();
        return view('kontakti.index', compact('kontakti'));
    }

    public function create()
    {
        $tvrtke = Tvrtka::all();
        return view('kontakti.create', compact('tvrtke'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tvrtka_id' => 'nullable|exists:tvrtke,id',
            'ime'       => 'required|string|max:255',
            'prezime'   => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'telefon'   => 'nullable|string|max:50',
            'status'    => 'required|string',
        ]);

        Kontakt::create($validated);

        return redirect()->route('kontakti.index')->with('success', 'Kontakt je uspješno kreiran.');
    }

    public function edit(Kontakt $kontakt)
    {
        $tvrtke = \App\Models\Tvrtka::orderBy('naziv')->get();
        return view('kontakti.edit', compact('kontakt', 'tvrtke'));
    }

    public function update(Request $request, Kontakt $kontakt)
    {
        $validated = $request->validate([
            'tvrtka_id' => 'nullable|exists:tvrtke,id',
            'ime'       => 'required|string|max:255',
            'prezime'   => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'telefon'   => 'nullable|string|max:50',
            'status'    => 'required|string',
        ]);

        $kontakt->update($validated);
        return redirect()->route('kontakti.index')->with('success', 'Kontakt je ažuriran.');
    }

    public function destroy(Kontakt $kontakt)
    {
        $kontakt->delete();
        return redirect()->route('kontakti.index')->with('success', 'Kontakt je obrisan.');
    }
}

