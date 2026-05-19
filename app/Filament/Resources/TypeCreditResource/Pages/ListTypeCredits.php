<?php

namespace App\Filament\Resources\TypeCreditResource\Pages;

use App\Filament\Resources\TypeCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeCredits extends ListRecords
{
    protected static string $resource = TypeCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
