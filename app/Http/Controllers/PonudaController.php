<?php

namespace App\Http\Controllers;

use App\Models\Ponuda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PonudaController extends Controller
{
    public function index()
    {
        $ponude = Ponuda::with(['deal.tvrtka'])->get();
        return view('ponude.index', compact('ponude'));
    }

    public function show(Ponuda $ponuda)
    {
        $ponuda->load(['deal.tvrtka', 'deal.kontakt']);
        return view('ponude.show', compact('ponuda'));
    }



    public function exportPdf(Ponuda $ponuda)
    {
        $ponuda->load(['deal.tvrtka', 'deal.kontakt']);
        $pdf = Pdf::loadView('ponude.pdf', compact('ponuda'));
        return $pdf->download('Ponuda-' . $ponuda->broj_ponude . '.pdf');
    }

    public function destroy(Ponuda $ponuda)
    {
        $ponuda->delete();
        return redirect()->route('ponude.index')->with('success', 'Ponuda je obrisana.');
    }
}
