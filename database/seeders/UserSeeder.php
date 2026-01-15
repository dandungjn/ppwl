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
        $admin = User::create([
            'name' => 'Mas Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');
    }
}
