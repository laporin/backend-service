<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\AgentMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class LeaveAgentTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_leave_agents()
    {
        $user = User::factory()->withPersonalAgent()->create();

        $user->currentAgent->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->call('leaveAgent');

        $this->assertCount(0, $user->currentAgent->fresh()->users);
    }

    public function test_agent_owners_cant_leave_their_own_agent()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->call('leaveAgent')
                        ->assertHasErrors(['agent']);

        $this->assertNotNull($user->currentAgent->fresh());
    }
}
