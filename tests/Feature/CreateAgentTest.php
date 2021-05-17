<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\CreateAgentForm;
use Livewire\Livewire;
use Tests\TestCase;

class CreateAgentTest extends TestCase
{
    use RefreshDatabase;

    public function test_agents_can_be_created()
    {
        $this->actingAs($user = User::factory()->withPersonalAgent()->create());

        Livewire::test(CreateAgentForm::class)
                    ->set(['state' => ['name' => 'Test Agent']])
                    ->call('createAgent');

        $this->assertCount(2, $user->fresh()->ownedAgents);
        $this->assertEquals('Test Agent', $user->fresh()->ownedAgents()->latest('id')->first()->name);
    }
}
