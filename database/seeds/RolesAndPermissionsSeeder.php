<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles .
        $role   = Role::create(['name' => 'super-admin']);
        Role::create(['name' => "admin"]);

        // Permissions For Users
        Permission::create(['name' => "create users"]);
        Permission::create(['name' => "read users"]);
        Permission::create(['name' => "update users"]);
        Permission::create(['name' => "delete users"]);

        // Permissions For Categories
        Permission::create(['name' => "create categories"]);
        Permission::create(['name' => "read categories"]);
        Permission::create(['name' => "update categories"]);
        Permission::create(['name' => "delete categories"]);

        // Permissions For Authors
        Permission::create(['name' => "create authors"]);
        Permission::create(['name' => "read authors"]);
        Permission::create(['name' => "update authors"]);
        Permission::create(['name' => "delete authors"]);

        // Permissions For Comments
        Permission::create(['name' => "create comments"]);
        Permission::create(['name' => "read comments"]);
        Permission::create(['name' => "update comments"]);
        Permission::create(['name' => "delete comments"]);

        // Permissions For Books
        Permission::create(['name' => "create books"]);
        Permission::create(['name' => "read books"]);
        Permission::create(['name' => "update books"]);
        Permission::create(['name' => "delete books"]);

        // Give All Permissions To Super Admin.
        $role->givePermissionTo(Permission::all());

    }
}
