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
        Permission::create(['name' => 'view authorizations', 'permission_description' => 'This permission allows a user to view the different authorization features that can be applied on a user', 'guard_name' => 'web']);
        Permission::create(['name' => 'view roles and permissions', 'permission_description' => 'This permission allows a user to view the roles and permissions panel', 'guard_name' => 'web']);
        Permission::create(['name' => 'add role', 'permission_description' => 'This permission allows a user to add a role to the database', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit role name', 'permission_description' => 'This permission allows a user to rename a role', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit role description', 'permission_description' => "This permission allows a user to rename a role's description", 'guard_name' => 'web']);
        Permission::create(['name' => 'edit role permission(s)', 'permission_description' => "This permission allows a user to edit a role's permission(s)", 'guard_name' => 'web']);
        Permission::create(['name' => 'assign role permission(s)', 'permission_description' => "This permission allows a user to assign a role permission(s)", 'guard_name' => 'web']);
        Permission::create(['name' => 'delete role', 'permission_description' => 'This permission allows a user to delete a role from the database', 'guard_name' => 'web']);

        Permission::create(['name' => 'view users', 'permission_description' => 'This permission allows a user to view the current users', 'guard_name' => 'web']);
        Permission::create(['name' => 'add user', 'permission_description' => 'This permission allows a user to add a user to the database', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user role', 'permission_description' => 'This permission allows a user to re-assign a role to the current users', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user association', 'permission_description' => 'This permission allows a user to update the powerBi account a user is associated with', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user table', 'permission_description' => 'This permission allows a user to apply a table filter for a user viewing the PowerBi report', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user column', 'permission_description' => 'This permission allows a user to apply a column filter for a table for a user viewing the PowerBi report', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user value', 'permission_description' => 'This permission allows a user to apply a value filter for a column for a user viewing the PowerBi report', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete user', 'permission_description' => 'This permission allows a user to delete a user from the database', 'guard_name' => 'web']);

        Permission::create(['name' => 'view powerbi account(s)', 'permission_description' => 'This permission allows a user to view the powerBi accounts that can be associated with a user', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete powerbi account', 'permission_description' => 'This permission allows a user to delete an association powerBi account from the database', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete filters', 'permission_description' => 'This permission allows a user to delete data filters from the database', 'guard_name' => 'web']);
        Permission::create(['name' => 'view data filters', 'permission_description' => 'This permission allows a user to view the data filters that can be applied to a user viewing the PowerBi report', 'guard_name' => 'web']);
    }
}
