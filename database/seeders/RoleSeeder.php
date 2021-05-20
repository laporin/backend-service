<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'super-agent',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'agent',
            'guard_name' => 'web',
        ]);
    }
}
