<?php

namespace App\Filament\Resources\VirementResource\Pages;

use App\Filament\Resources\VirementResource;
use App\Models\mouvementBanque;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVirement extends CreateRecord
{
    protected static string $resource = VirementResource::class;


    protected function afterCreate(): void
    {
        $virement = $this->record; // le CreditSocial créé
        

        // créer mouvement bancaire
        mouvementBanque::create([
            'reference' => $virement->reference,
            'type' => 'credit',
            'amount' => $virement->amount,
            'description' => 'Virement bancaire pour l\'unité ' . $virement->unite_id . 'le compte bancaire  ' . $virement->bank_account_id,
            'virement_id' => $virement->id,
            'date' => $virement->datevirement,

        ]);
    }
}
