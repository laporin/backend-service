<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\AddsTeamMembers as AddsAgentMembers;
use Laravel\Jetstream\Events\AddingTeamMember as AddingAgentMember;
use Laravel\Jetstream\Events\TeamMemberAdded as AgentMemberAdded;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;

class AddAgentMember implements AddsAgentMembers
{
    /**
     * Add a new agent member to the given agent.
     *
     * @param  mixed  $user
     * @param  mixed  $agent
     * @param  string  $email
     * @param  string|null  $role
     * @return void
     */
    public function add($user, $agent, string $email, string $role = null)
    {
        Gate::forUser($user)->authorize('addAgentMember', $agent);

        $this->validate($agent, $email, $role);

        $newAgentMember = Jetstream::findUserByEmailOrFail($email);

        AddingAgentMember::dispatch($agent, $newAgentMember);

        $agent->users()->attach(
            $newAgentMember, ['role' => $role]
        );

        AgentMemberAdded::dispatch($agent, $newAgentMember);
    }

    /**
     * Validate the add member operation.
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
        ], $this->rules(), [
            'email.exists' => __('We were unable to find a registered user with this email address.'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnAgent($agent, $email)
        )->validateWithBag('addAgentMember');
    }

    /**
     * Get the validation rules for adding a agent member.
     *
     * @return array
     */
    protected function rules()
    {
        return array_filter([
            'email' => ['required', 'email', 'exists:users'],
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
