<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Vider le cache des permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ── Permissions RH ──────────────────────────────
        Permission::create(['name' => 'rh.view']);
        Permission::create(['name' => 'rh.create']);
        Permission::create(['name' => 'rh.edit']);
        Permission::create(['name' => 'rh.delete']);

        // ── Permissions Comptabilité ─────────────────────
        Permission::create(['name' => 'comptabilite.view']);
        Permission::create(['name' => 'comptabilite.create']);
        Permission::create(['name' => 'comptabilite.edit']);
        Permission::create(['name' => 'comptabilite.delete']);

        // ── Permissions Service Social ───────────────────
        Permission::create(['name' => 'service_social.view']);
        Permission::create(['name' => 'service_social.create']);
        Permission::create(['name' => 'service_social.edit']);
        Permission::create(['name' => 'service_social.delete']);

        // ── Création des rôles et assignation ────────────
        $roleRH = Role::create(['name' => 'RH']);
        $roleRH->givePermissionTo([
            'rh.view', 'rh.create', 'rh.edit', 'rh.delete',
        ]);

        $roleCompta = Role::create(['name' => 'Comptabilité']);
        $roleCompta->givePermissionTo([
            'comptabilite.view', 'comptabilite.create',
            'comptabilite.edit', 'comptabilite.delete',
        ]);

        $roleServiceSocial = Role::create(['name' => 'Service Social']);
        $roleServiceSocial->givePermissionTo([
            'service_social.view', 'service_social.create',
            'service_social.edit', 'service_social.delete',
        ]);
    }
}
