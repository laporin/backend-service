<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams as CreatesAgents;
use Laravel\Jetstream\Events\AddingTeam as AddingAgent;
use Laravel\Jetstream\Jetstream;

class CreateAgent implements CreatesAgents
{
    /**
     * Validate and create a new agent for the given user.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return mixed
     */
    public function create($user, array $input)
    {
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createAgent');

        AddingAgent::dispatch($user);

        $user->switchAgent($agent = $user->ownedAgents()->create([
            'name' => $input['name'],
            'personal_agent' => false,
        ]));

        return $agent;
    }
}
