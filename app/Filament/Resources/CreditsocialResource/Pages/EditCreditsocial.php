<?php

namespace App\Filament\Resources\CreditsocialResource\Pages;

use App\Filament\Resources\CreditsocialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCreditsocial extends EditRecord
{
    protected static string $resource = CreditsocialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
