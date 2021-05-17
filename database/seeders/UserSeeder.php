<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('user');

        $superAgent = User::create([
            'name' => 'super agent',
            'username' => 'superagent',
            'email' => 'super.agent@example.com',
            'password' => bcrypt('12345678')
        ]);
        $superAgent->assignRole('super-agent');

        $agent = User::create([
            'name' => 'agent',
            'username' => 'agent',
            'email' => 'agent@example.com',
            'password' => bcrypt('12345678')
        ]);
        $agent->assignRole('agent');
    }
}
