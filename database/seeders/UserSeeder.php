<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\AgentUser;
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
        if (User::count() != 0) {
            return;
        }

        $admin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');

        $adminAgent = Agent::firstOrCreate([
            'name' => 'Administrator',
            'user_id' => $admin->id,
            'personal_agent' => true,
        ]);

        AgentUser::create([
            'agent_id' => $adminAgent->id,
            'user_id' => $admin->id,
            'role' => 'admin'
        ]);

        $admin->switchAgent($adminAgent);

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

        $groupAgent = Agent::firstOrCreate([
            'name' => 'Group',
            'user_id' => $superAgent->id,
            'personal_agent' => false,
        ]);

        AgentUser::create([
            'agent_id' => $groupAgent->id,
            'user_id' => $superAgent->id,
            'role' => 'admin'
        ]);

        $superAgent->switchAgent($groupAgent);

        $agent = User::create([
            'name' => 'agent',
            'username' => 'agent',
            'email' => 'agent@example.com',
            'password' => bcrypt('12345678')
        ]);
        $agent->assignRole('agent');

        AgentUser::create([
            'agent_id' => $groupAgent->id,
            'user_id' => $agent->id,
            'role' => 'editor'
        ]);

        $agent->switchAgent($groupAgent);
    }
}
