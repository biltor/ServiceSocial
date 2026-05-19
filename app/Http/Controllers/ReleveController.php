<?php

namespace App\Http\Controllers;

use App\Models\mouvementBanque;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;    

class ReleveController extends Controller
{
public function generate(Request $request)
{
    $from = $request->from;
    echo ($from);
    $to = $request->to;
    echo($to);

       $mouvements = mouvementBanque::whereBetween('date', [$from, $to])
        ->get();

     /*$mouvements = mouvementBanque::whereBetween('date', [$from, $to])
        ->orderBy('id')
        ->get(); */

    //  calcul solde initial
    $soldeInitial = mouvementBanque::where('date', '<', $from)
        ->orderByDesc('date')
        ->value('balance') ?? 0;

    $pdf = SnappyPdf::loadView(
        'pdf.releve',
        compact('mouvements', 'from', 'to', 'soldeInitial')
    );

    return $pdf->download('releve-'.$from.'-'.$to.'.pdf');
}
}