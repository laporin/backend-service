<?php

namespace App\Actions\Jetstream;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\RemovesTeamMembers as RemovesAgentMembers;
use Laravel\Jetstream\Events\TeamMemberRemoved as AgentMemberRemoved;

class RemoveAgentMember implements RemovesAgentMembers
{
    /**
     * Remove the agent member from the given agent.
     *
     * @param  mixed  $user
     * @param  mixed  $agent
     * @param  mixed  $agentMember
     * @return void
     */
    public function remove($user, $agent, $agentMember)
    {
        $this->authorize($user, $agent, $agentMember);

        $this->ensureUserDoesNotOwnAgent($agentMember, $agent);

        $agent->removeUser($agentMember);

        AgentMemberRemoved::dispatch($agent, $agentMember);
    }

    /**
     * Authorize that the user can remove the agent member.
     *
     * @param  mixed  $user
     * @param  mixed  $agent
     * @param  mixed  $agentMember
     * @return void
     */
    protected function authorize($user, $agent, $agentMember)
    {
        if (! Gate::forUser($user)->check('removeAgentMember', $agent) &&
            $user->id !== $agentMember->id) {
            throw new AuthorizationException;
        }
    }

    /**
     * Ensure that the currently authenticated user does not own the agent.
     *
     * @param  mixed  $agentMember
     * @param  mixed  $agent
     * @return void
     */
    protected function ensureUserDoesNotOwnAgent($agentMember, $agent)
    {
        if ($agentMember->id === $agent->owner->id) {
            throw ValidationException::withMessages([
                'agent' => [__('You may not leave a agent that you created.')],
            ])->errorBag('removeAgentMember');
        }
    }
}
