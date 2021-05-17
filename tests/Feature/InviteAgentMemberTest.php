<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\Http\Livewire\AgentMemberManager;
use Laravel\Jetstream\Mail\AgentInvitation;
use Livewire\Livewire;
use Tests\TestCase;

class InviteAgentMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_agent_members_can_be_invited_to_agent()
    {
        Mail::fake();

        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->set('addAgentMemberForm', [
                            'email' => 'test@example.com',
                            'role' => 'admin',
                        ])->call('addAgentMember');

        Mail::assertSent(AgentInvitation::class);

        $this->assertCount(1, $user->currentAgent->fresh()->agentInvitations);
    }

    public function test_agent_member_invitations_can_be_cancelled()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        // Add the agent member...
        $component = Livewire::test(AgentMemberManager::class, ['agent' => $user->currentAgent])
                        ->set('addAgentMemberForm', [
                            'email' => 'test@example.com',
                            'role' => 'admin',
                        ])->call('addAgentMember');

        $invitationId = $user->currentAgent->fresh()->agentInvitations->first()->id;

        // Cancel the agent invitation...
        $component->call('cancelAgentInvitation', $invitationId);

        $this->assertCount(0, $user->currentAgent->fresh()->agentInvitations);
    }
}
