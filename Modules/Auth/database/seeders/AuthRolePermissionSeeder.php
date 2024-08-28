<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthRolePermissionSeeder extends Seeder
{
    public function run()
    {

        $adminRole = Role::updateOrCreate(['name' => 'admin'], ['name' => 'admin']);
        $userRole = Role::updateOrCreate(['name' => 'user'], ['name' => 'user']);


        $permissions = [
            'view articles',
            'edit articles',
            'delete articles',
            'create articles',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission], ['name' => $permission]);
        }


        $adminRole->syncPermissions(Permission::all());
        $userRole->syncPermissions(Permission::where('name', 'view articles')->get());
    }
}
