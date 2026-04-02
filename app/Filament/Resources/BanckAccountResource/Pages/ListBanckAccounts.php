<?php

namespace App\Filament\Resources\BanckAccountResource\Pages;

use App\Filament\Resources\BanckAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBanckAccounts extends ListRecords
{
    protected static string $resource = BanckAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
