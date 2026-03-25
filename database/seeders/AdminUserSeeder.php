<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@mahasagar.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Mahasagar@2026*'),
            ]
        );

        $role = Role::where('name', 'superadmin')->first();

        if ($role && !$user->roles->contains($role->id)) {
            $user->roles()->attach($role->id);
        }
    }
}