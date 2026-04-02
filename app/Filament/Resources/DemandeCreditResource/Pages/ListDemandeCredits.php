<?php

namespace App\Filament\Resources\DemandeCreditResource\Pages;

use App\Filament\Resources\DemandeCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDemandeCredits extends ListRecords
{
     protected static ?string $title = 'Liste  demande de crédit';
    protected static string $resource = DemandeCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
