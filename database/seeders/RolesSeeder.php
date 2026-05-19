<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // ── Permissions RH ──────────────────────────
        $permissionsRH = [
            'view_employe',
            'create_employe',
            'edit_employe',
            'delete_employe',
            'view_contrat',

        ];

        // ── Permissions Comptabilité ─────────────────
        $permissionsCompta = [
            'view_virement',
            'create_virement',
            'edit_virement',
            'delete_virement',
            'view_muvement',
        ];

        // ── Permissions Service Social ───────────────
        $permissionsServiceSocial = [
            'view_demande-credits',
            'create_demande-credits',
            'edit_demande-credits',
            'delete_demande-credits',
            'view_creditsocials',
            'create_creditsocials',
            'edit_creditsocials',
            'delete_creditsocials',
            'view_don',
            'create_don',
            'edit_don',
            'delete_don',
            'view_type-credits',
            'create_type-credits',
            'edit_type-credits',
            'delete_type-credits',
        ];

        // Créer toutes les permissions
        foreach (array_merge($permissionsRH, $permissionsCompta, $permissionsServiceSocial) as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Créer les rôles et assigner permissions
        $roleRH = Role::firstOrCreate(['name' => 'RH']);
        $roleRH->syncPermissions($permissionsRH);

        $roleCompta = Role::firstOrCreate(['name' => 'Comptabilité']);
        $roleCompta->syncPermissions($permissionsCompta);

        $roleServiceSocial = Role::firstOrCreate(['name' => 'Service Social']);
        $roleServiceSocial->syncPermissions($permissionsServiceSocial);

        // ── Créer les utilisateurs de test ───────────
        $userRH = User::firstOrCreate(
            ['email' => 'rh@exemple.com'],
            ['name' => 'Responsable RH', 'password' => bcrypt('password')]
        );
        $userRH->assignRole('RH');

        $userCompta = User::firstOrCreate(
            ['email' => 'compta@exemple.com'],
            ['name' => 'Comptable', 'password' => bcrypt('password')]
        );
        $userCompta->assignRole('Comptabilité');

        $userSocial = User::firstOrCreate(
            ['email' => 'social@exemple.com'],
            ['name' => 'Agent Social', 'password' => bcrypt('password')]
        );
        $userSocial->assignRole('Service Social');
    }
}
