<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\AgentMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateAgentMemberRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_agent_member_roles_can_be_updated()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        $user->currentAgent->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->set('managingRoleFor', $otherUser)
                        ->set('currentRole', 'editor')
                        ->call('updateRole');

        $this->assertTrue($otherUser->fresh()->hasAgentRole(
            $user->currentAgent->fresh(), 'editor'
        ));
    }

    public function test_only_agent_owner_can_update_agent_member_roles()
    {
        $user = User::factory()->withPersonalAgent()->create();

        $user->currentAgent->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->set('managingRoleFor', $otherUser)
                        ->set('currentRole', 'editor')
                        ->call('updateRole')
                        ->assertStatus(403);

        $this->assertTrue($otherUser->fresh()->hasAgentRole(
            $user->currentAgent->fresh(), 'admin'
        ));
    }
}
