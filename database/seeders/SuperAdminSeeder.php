<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // créer le rôle si inexistant
        $role = Role::firstOrCreate([
            'name' => 'super_admin',
        ]);

        // créer user admin
        $user = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin'),
            ]
        );

        // assigner rôle
        $user->assignRole($role);
    }
}
