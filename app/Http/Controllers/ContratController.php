<?php

namespace App\Http\Controllers;

use App\Models\contrats;
use Barryvdh\Snappy\Facades\SnappyPdf;



class ContratController extends Controller
{
    public function generatePdf($id)
    {
        $contrat = contrats::with([
            'employee',
            'creditSocial'
        ])->findOrFail($id);

        $pdf = SnappyPdf::loadView('pdf.contrat', compact('contrat'));

        return $pdf->download('contrat-' . $contrat->name . '.pdf');
    }

    public function generateArabic($id)
    {
        $contrat = contrats::with(
            'employee',
            'creditSocial'
        
        )->findOrFail($id);

        $pdf = SnappyPdf::loadView('pdf.contrat_ar', compact('contrat'));

        return $pdf->download('contrat-ar-' . $contrat->reference . '.pdf');
    }
}
