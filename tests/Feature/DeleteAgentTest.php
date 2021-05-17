<?php

namespace Tests\Feature;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteAgentForm;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAgentTest extends TestCase
{
    use RefreshDatabase;

    public function test_agents_can_be_deleted()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        $user->ownedAgents()->save($agent = Agent::factory()->make([
            'personal_agent' => false,
        ]));

        $agent->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'test-role']
        );

        $component = Livewire::test(DeleteAgentForm::class, ['agent' => $agent->fresh()])
                                ->call('deleteAgent');

        $this->assertNull($agent->fresh());
        $this->assertCount(0, $otherUser->fresh()->agents);
    }

    public function test_personal_agents_cant_be_deleted()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        $component = Livewire::test(DeleteAgentForm::class, ['agent' => $user->currentAgent])
                                ->call('deleteAgent')
                                ->assertHasErrors(['agent']);

        $this->assertNotNull($user->currentAgent->fresh());
    }
}
