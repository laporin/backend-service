<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateAgentNameForm;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateAgentNameTest extends TestCase
{
    use RefreshDatabase;

    public function test_agent_names_can_be_updated()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        Livewire::test(UpdateAgentNameForm::class, ['agent' => $user->currentAgent])
                    ->set(['state' => ['name' => 'Test Agent']])
                    ->call('updateAgentName');

        $this->assertCount(1, $user->fresh()->ownedAgents);
        $this->assertEquals('Test Agent', $user->currentAgent->fresh()->name);
    }
}
