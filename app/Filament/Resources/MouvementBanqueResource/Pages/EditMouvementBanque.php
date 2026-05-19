<?php

namespace App\Filament\Resources\MouvementBanqueResource\Pages;

use App\Filament\Resources\MouvementBanqueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMouvementBanque extends EditRecord
{
    protected static string $resource = MouvementBanqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
