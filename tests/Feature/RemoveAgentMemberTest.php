<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\AgentMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class RemoveAgentMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_agent_members_can_be_removed_from_agents()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        $user->currentAgent->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->set('agentMemberIdBeingRemoved', $otherUser->id)
                        ->call('removeAgentMember');

        $this->assertCount(0, $user->currentAgent->fresh()->users);
    }

    public function test_only_agent_owner_can_remove_agent_members()
    {
        $user = User::factory()->withPersonalAgent()->create();

        $user->currentAgent->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->set('agentMemberIdBeingRemoved', $user->id)
                        ->call('removeAgentMember')
                        ->assertStatus(403);
    }
}
