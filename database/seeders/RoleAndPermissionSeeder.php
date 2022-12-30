<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission::create(['name' => 'create-users']);
        // Permission::create(['name' => 'add-book']);
        // Permission::create(['name' => 'remove-book']);
        // Permission::create(['name' => 'rent-book']);
        // Permission::create(['name' => 'admin-panel']);
        Permission::create(['name' => 'block-user']);
        Permission::create(['name' => 'all-rents']);
        $admin_role = Role::create(['name' => 'Admin']);
        $bibliotekarz_role = Role::create(['name' => 'Biliotekarz']);
        $klient_role = Role::create(['name' => 'Klient']);

        $admin_role->givePermissionsTo([
            // 'create-users',
            // 'add-book',
            // 'remove-book',
            // 'rent-book',
            // 'admin-panel',
            'block-user',
            'all-rents'
            
        ]);
        $bibliotekarz_role->givePermissionsTo([
            // 'add-book',
            // 'remove-book',
            // 'rent-book',
            'block-user',
            'all-rents'
        ]);
        $klient_role->givePermissionsTo([
            // 'rent-book',
        ]);
    }
}
