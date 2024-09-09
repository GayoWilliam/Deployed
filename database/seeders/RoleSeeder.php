<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'User', 'role_description' => 'This one has user permissions', 'guard_name' => 'web']);
        Role::create(['name' => 'Super Admin', 'role_description' => 'This one has all permissions', 'guard_name' => 'web']);
    }
}
