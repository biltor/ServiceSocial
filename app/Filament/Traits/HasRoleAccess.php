<?php

namespace App\Filament\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait HasRoleAccess
{
protected static function getAllowedRoles(): array
{
    return [];
}



    protected static function hasAccess(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            return false;
        }

        if ($user->hasRole('super_admin')) {
            return true;
        }

        $role = static::getAllowedRoles();

        return $role ? $user->hasRole($role) : false;
    }

    public static function canViewAny(): bool
    {
        return static::hasAccess();
    }

    public static function canCreate(): bool
    {
        return static::hasAccess();
    }

    public static function canEdit($record): bool
    {
        return static::hasAccess();
    }

    public static function canDelete($record): bool
    {
        return static::hasAccess();
    }

    public static function canView($record): bool
    {
        return static::hasAccess();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::hasAccess();
    }
}
