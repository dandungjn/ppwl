<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- ADMIN ----------
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');


        // ---------- STAFF ----------
        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $staff->assignRole('staff');

        // ---------- OTHER ----------
        $banyu = User::create([
            'name' => 'Banyu',
            'email' => 'banyu@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $koras = User::create([
            'name' => 'Koras',
            'email' => 'koras@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $raffa = User::create([
            'name' => 'Raffa',
            'email' => 'raffa@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $nanang = User::create([
            'name' => 'Nanang',
            'email' => 'nanang@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $banyu->assignRole('staff');
        $koras->assignRole('staff');
        $raffa->assignRole('staff');
        $nanang->assignRole('staff');
    }
}
