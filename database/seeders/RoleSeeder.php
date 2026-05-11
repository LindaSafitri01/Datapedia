<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $konsultan = Role::create(['name' => 'konsultan']);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $admin->id,
        ]);

        User::create([
            'name' => 'Konsultan User',
            'email' => 'konsultan@example.com',
            'password' => Hash::make('password'),
            'role_id' => $konsultan->id,
        ]);
    }
}

