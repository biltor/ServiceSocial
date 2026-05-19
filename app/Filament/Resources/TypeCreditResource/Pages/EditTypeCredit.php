<?php

namespace App\Filament\Resources\TypeCreditResource\Pages;

use App\Filament\Resources\TypeCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeCredit extends EditRecord
{
    protected static string $resource = TypeCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
