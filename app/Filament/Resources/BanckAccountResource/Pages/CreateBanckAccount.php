<?php

namespace App\Filament\Resources\BanckAccountResource\Pages;

use App\Filament\Resources\BanckAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBanckAccount extends CreateRecord
{
    protected static ?string $title = 'Créer un compte bancaire';
    protected static string $resource = BanckAccountResource::class;
    
}
