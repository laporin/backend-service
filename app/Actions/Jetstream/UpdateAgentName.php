<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\UpdatesTeamNames as UpdatesAgentNames;

class UpdateAgentName implements UpdatesAgentNames
{
    /**
     * Validate and update the given agent's name.
     *
     * @param  mixed  $user
     * @param  mixed  $agent
     * @param  array  $input
     * @return void
     */
    public function update($user, $agent, array $input)
    {
        Gate::forUser($user)->authorize('update', $agent);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateAgentName');

        $agent->forceFill([
            'name' => $input['name'],
        ])->save();
    }
}
