<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view books',
            'create books',
            'edit books',
            'delete books',

            'borrow books',
            'return books',

            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin'
        ]);
        $admin->syncPermissions(Permission::all());

        $petugas = Role::firstOrCreate([
            'name' => 'Petugas'
        ]);
        $petugas->syncPermissions([
            'view books',
            'create books',
            'edit books',
            
            'return books',

            'view categories',
            'create categories',
            'edit categories',
        ]);


        $user = Role::firstOrCreate([
            'name' => 'User'
        ]);
        $user->syncPermissions([
            'view books',
            'borrow books',

            'view categories',
        ]);
    }
}
