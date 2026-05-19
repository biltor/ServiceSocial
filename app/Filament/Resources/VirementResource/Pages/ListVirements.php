<?php

namespace App\Filament\Resources\VirementResource\Pages;

use App\Filament\Resources\VirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVirements extends ListRecords
{
    protected static string $resource = VirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
