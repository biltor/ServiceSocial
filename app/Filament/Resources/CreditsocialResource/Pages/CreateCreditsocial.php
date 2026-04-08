<?php

namespace App\Filament\Resources\CreditsocialResource\Pages;

use App\Filament\Resources\CreditsocialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Contrat;
use App\Models\contrats;

class CreateCreditsocial extends CreateRecord
{
    protected static string $resource = CreditsocialResource::class;

    
protected function afterCreate(): void
{
    $credit = $this->record; // le CreditSocial créé

    // 1️⃣ Valider la demande
    $demande = $credit->demandeCredit;
    if ($demande) {
        $demande->etat = 'validé';
        $demande->save();
    }

    // 2️⃣ Créer le contrat uniquement si aucun contrat n'existe pour ce crédit
    if (!contrats::where('credit_social_id', $credit->id)->exists()) {
        contrats::create([
            'reference' => 'CTR-' . now()->format('YmdHis'),
            'credit_social_id' => $credit->id,
            'employee_id' => $credit->employee_id,
            'amount' => $credit->amount_accord,
            'amount_retenu' => $credit->amout_retenu,
            'start_date' => $credit->date_contrat ?? now(),
            'state' => 'draft',
        ]);
    }
}




}