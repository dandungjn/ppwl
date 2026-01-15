<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'banks',
        ];

        foreach ($modules as $module) {
            Permission::firstOrCreate(['name' => "$module.view"]);
            Permission::firstOrCreate(['name' => "$module.create"]);
            Permission::firstOrCreate(['name' => "$module.edit"]);
            Permission::firstOrCreate(['name' => "$module.delete"]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        $staff = Role::firstOrCreate(['name' => 'staff']);
        $staff->syncPermissions(
            Permission::where('name', 'like', '%.view')->get()
        );
    }
}
