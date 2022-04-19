<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * User: alfredo
 * Email: alfredoeka@outlook.com
 */

class RolesAndPermissions extends Seeder
{
    public function run()
    {

        // create roles
        $superAdmin = Role::create(['guard_name' => 'admin', 'name' => 'super-admin']);
        $admin = Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        $donatur = Role::create(['name' => 'donatur']);
    }
}