<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\bookListing;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'add-book']);
        Permission::create(['name' => 'remove-book']);
        Permission::create(['name' => 'rent-book']);
        Permission::create(['name' => 'admin-panel']);
        Permission::create(['name' => 'all-rents']);
        Permission::create(['name' => 'block-user']);
        $admin_role = Role::create(['name' => 'Admin']);
        $bibliotekarz_role = Role::create(['name' => 'Bibliotekarz']);
        $klient_role = Role::create(['name' => 'Klient']);

        $admin_role->givePermissionTo([
            'create-users',
            'add-book',
            'remove-book',
            'rent-book',
            'admin-panel',
            'all-rents',
            'block-user'
        ]);
        $bibliotekarz_role->givePermissionTo([
            'add-book',
            'remove-book',
            'rent-book',
            'all-rents',
            'block-user'
        ]);
        $klient_role->givePermissionTo([
            'rent-book',
        ]);

    }
}
