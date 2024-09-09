<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view admin', 'permission_description' => 'This permission allows a user to view the administrator panel', 'guard_name' => 'web']);
        Permission::create(['name' => 'view roles and permissions', 'permission_description' => 'This permission allows a user to view the roles and permissions panel', 'guard_name' => 'web']);
        Permission::create(['name' => 'view users', 'permission_description' => 'This permission allows a user to view the current users', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user role', 'permission_description' => 'This permission allows a user to re-assign a role to the current users', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete user', 'permission_description' => 'This permission allows a user to delete a user from the database', 'guard_name' => 'web']);
        Permission::create(['name' => 'add role', 'permission_description' => 'This permission allows a user to add a role to the database', 'guard_name' => 'web']);
        Permission::create(['name' => 'add user', 'permission_description' => 'This permission allows a user to add a user to the database', 'guard_name' => 'web']);
        Permission::create(['name' => 'view associations', 'permission_description' => 'This permission allows a user to view the powerBi accounts that can be associated with a user', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user association', 'permission_description' => 'This permission allows a user to update the powerBi account a user is associated with', 'guard_name' => 'web']);
    }
}
