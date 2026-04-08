<?php

namespace App\Filament\Resources\DemandeCreditResource\Pages;

use App\Filament\Resources\DemandeCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDemandeCredit extends CreateRecord
{
    protected static ?string $title = 'Créer une demande de crédit';
    protected static string $resource = DemandeCreditResource::class;

    // Hook exécuté après création
    protected function afterCreate(): void
    {
        $creditSocial = $this->record; // le CreditSocial créé

        // Récupère la demande de crédit liée
        $demande = $creditSocial->demandeCredit;

        if ($demande) {
            $demande->state = 'validé'; // ou 'terminer' selon ton enum
            $demande->save();
        }
    }
}
