<?php

namespace App\Policies;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function view(User $user, Agent $agent)
    {
        return $user->belongsToAgent($agent);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function update(User $user, Agent $agent)
    {
        return $user->ownsAgent($agent);
    }

    /**
     * Determine whether the user can add agent members.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function addAgentMember(User $user, Agent $agent)
    {
        return $user->ownsAgent($agent);
    }

    /**
     * Determine whether the user can update agent member permissions.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function updateAgentMember(User $user, Agent $agent)
    {
        return $user->ownsAgent($agent);
    }

    /**
     * Determine whether the user can remove agent members.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function removeAgentMember(User $user, Agent $agent)
    {
        return $user->ownsAgent($agent);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agent  $agent
     * @return mixed
     */
    public function delete(User $user, Agent $agent)
    {
        return $user->ownsAgent($agent);
    }
}
