<?php

namespace App\Http\Controllers;

use App\Models\Tvrtka;
use Illuminate\Http\Request;

class TvrtkaController extends Controller
{
    public function index()
    {
        $tvrtke = Tvrtka::withCount('kontakti')->get();

        return view('tvrtke.index', compact('tvrtke'));
    }

    public function create()
    {
        return view('tvrtke.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv'   => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'telefon' => 'nullable|string|max:50',
            'adresa'  => 'nullable|string|max:255',
            'status'  => 'required|string',
        ]);

        Tvrtka::create($validated);

        return redirect()->route('tvrtke.index')->with('success', 'Tvrtka je uspješno kreirana.');
    }

    public function edit(Tvrtka $tvrtka)
    {
        return view('tvrtke.edit', compact('tvrtka'));
    }

    public function update(Request $request, Tvrtka $tvrtka)
    {
        $validated = $request->validate([
            'naziv'   => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'telefon' => 'nullable|string|max:50',
            'adresa'  => 'nullable|string|max:255',
            'status'  => 'required|string',
        ]);

        $tvrtka->update($validated);

        return redirect()->route('tvrtke.index')->with('success', 'Tvrtka je uspješno ažurirana.');
    }

    public function destroy(Tvrtka $tvrtka)
    {
        $tvrtka->delete();
        return redirect()->route('tvrtke.index')->with('success', 'Tvrtka obrisana.');
    }
}
