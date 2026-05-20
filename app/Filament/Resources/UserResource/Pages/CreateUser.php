<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

        protected function afterCreate(): void
    {
        // Assigner le rôle sélectionné
        $role = $this->form->getState()['roles'] ?? null;

        if ($role) {
            $this->record->syncRoles([$role]);
        }
    }
}
