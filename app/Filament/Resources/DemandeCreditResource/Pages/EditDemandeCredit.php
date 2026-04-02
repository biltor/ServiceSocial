<?php

namespace App\Filament\Resources\DemandeCreditResource\Pages;

use App\Filament\Resources\DemandeCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDemandeCredit extends EditRecord
{
    protected static string $resource = DemandeCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
