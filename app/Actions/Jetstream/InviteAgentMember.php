<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Contracts\InvitesTeamMembers as InvitesAgentMembers;
use Laravel\Jetstream\Events\InvitingTeamMember as InvitingAgentMember;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Mail\TeamInvitation as AgentInvitation;
use Laravel\Jetstream\Rules\Role;

class InviteAgentMember implements InvitesAgentMembers
{
    /**
     * Invite a new agent member to the given agent.
     *
     * @param  mixed  $user
     * @param  mixed  $agent
     * @param  string  $email
     * @param  string|null  $role
     * @return void
     */
    public function invite($user, $agent, string $email, string $role = null)
    {
        Gate::forUser($user)->authorize('addAgentMember', $agent);

        $this->validate($agent, $email, $role);

        InvitingAgentMember::dispatch($agent, $email, $role);

        $invitation = $agent->agentInvitations()->create([
            'email' => $email,
            'role' => $role,
        ]);

        Mail::to($email)->send(new AgentInvitation($invitation));
    }

    /**
     * Validate the invite member operation.
     *
     * @param  mixed  $agent
     * @param  string  $email
     * @param  string|null  $role
     * @return void
     */
    protected function validate($agent, string $email, ?string $role)
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules($agent), [
            'email.unique' => __('This user has already been invited to the agent.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnAgent($agent, $email)
        )->validateWithBag('addAgentMember');
    }

    /**
     * Get the validation rules for inviting a agent member.
     *
     * @param  mixed  $agent
     * @return array
     */
    protected function rules($agent)
    {
        return array_filter([
            'email' => ['required', 'email', Rule::unique('agent_invitations')->where(function ($query) use ($agent) {
                $query->where('agent_id', $agent->id);
            })],
            'role' => Jetstream::hasRoles()
                            ? ['required', 'string', new Role]
                            : null,
        ]);
    }

    /**
     * Ensure that the user is not already on the agent.
     *
     * @param  mixed  $agent
     * @param  string  $email
     * @return \Closure
     */
    protected function ensureUserIsNotAlreadyOnAgent($agent, string $email)
    {
        return function ($validator) use ($agent, $email) {
            $validator->errors()->addIf(
                $agent->hasUserWithEmail($email),
                'email',
                __('This user already belongs to the agent.')
            );
        };
    }
}
