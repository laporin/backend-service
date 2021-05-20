<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\OwnerRole;
use Laravel\Sanctum\HasApiTokens;

trait HasAgents
{
    /**
     * Determine if the given agent is the current agent.
     *
     * @param  mixed  $agent
     * @return bool
     */
    public function isCurrentAgent($agent)
    {
        return $agent->id === $this->currentAgent->id;
    }

    /**
     * Get the current agent of the user's context.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currentAgent()
    {
        if (is_null($this->current_agent_id) && $this->id) {
            $this->switchAgent($this->personalAgent());
        }

        return $this->belongsTo(Jetstream::teamModel(), 'current_agent_id');
    }

    /**
     * Switch the user's context to the given agent.
     *
     * @param  mixed  $agent
     * @return bool
     */
    public function switchAgent($agent)
    {
        if (!$this->belongsToAgent($agent)) {
            return false;
        }

        $this->forceFill([
            'current_agent_id' => $agent->id,
        ])->save();

        $this->setRelation('currentAgent', $agent);

        return true;
    }

    /**
     * Get all of the agents the user owns or belongs to.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allAgents()
    {
        return $this->ownedAgents->merge($this->agents)->sortBy('name');
    }

    /**
     * Get all of the agents the user owns.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownedAgents()
    {
        return $this->hasMany(Jetstream::teamModel());
    }

    /**
     * Get all of the agents the user belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function agents()
    {
        return $this->belongsToMany(Jetstream::teamModel(), Jetstream::membershipModel())
            ->withPivot('role')
            ->withTimestamps()
            ->as('membership');
    }

    /**
     * Get the user's "personal" agent.
     *
     * @return \App\Models\Agent
     */
    public function personalAgent()
    {
        return $this->ownedAgents->where('personal_agent', true)->first();
    }

    /**
     * Determine if the user owns the given agent.
     *
     * @param  mixed  $agent
     * @return bool
     */
    public function ownsAgent($agent)
    {
        if (is_null($agent)) {
            return false;
        }

        return $this->id == $agent->{$this->getForeignKey()};
    }

    /**
     * Determine if the user belongs to the given agent.
     *
     * @param  mixed  $agent
     * @return bool
     */
    public function belongsToAgent($agent)
    {
        return $this->agents->contains(function ($t) use ($agent) {
            return $t->id === $agent->id;
        }) || $this->ownsAgent($agent);
    }

    /**
     * Get the role that the user has on the agent.
     *
     * @param  mixed  $agent
     * @return \Laravel\Jetstream\Role
     */
    public function agentRole($agent)
    {
        if ($this->ownsAgent($agent)) {
            return new OwnerRole;
        }

        if (!$this->belongsToAgent($agent)) {
            return;
        }

        return Jetstream::findRole($agent->users->where(
            'id',
            $this->id
        )->first()->membership->role);
    }

    /**
     * Determine if the user has the given role on the given agent.
     *
     * @param  mixed  $agent
     * @param  string  $role
     * @return bool
     */
    public function hasAgentRole($agent, string $role)
    {
        if ($this->ownsAgent($agent)) {
            return true;
        }

        return $this->belongsToAgent($agent) && optional(Jetstream::findRole($agent->users->where(
            'id',
            $this->id
        )->first()->membership->role))->key === $role;
    }

    /**
     * Get the user's permissions for the given agent.
     *
     * @param  mixed  $agent
     * @return array
     */
    public function agentPermissions($agent)
    {
        if ($this->ownsAgent($agent)) {
            return ['*'];
        }

        if (!$this->belongsToAgent($agent)) {
            return [];
        }

        return $this->agentRole($agent)->permissions;
    }

    /**
     * Determine if the user has the given permission on the given agent.
     *
     * @param  mixed  $agent
     * @param  string  $permission
     * @return bool
     */
    public function hasAgentPermission($agent, string $permission)
    {
        if ($this->ownsAgent($agent)) {
            return true;
        }

        if (!$this->belongsToAgent($agent)) {
            return false;
        }

        if (
            in_array(HasApiTokens::class, class_uses_recursive($this)) &&
            !$this->tokenCan($permission) &&
            $this->currentAccessToken() !== null
        ) {
            return false;
        }

        $permissions = $this->agentPermissions($agent);

        return in_array($permission, $permissions) ||
            in_array('*', $permissions) ||
            (Str::endsWith($permission, ':create') && in_array('*:create', $permissions)) ||
            (Str::endsWith($permission, ':update') && in_array('*:update', $permissions));
    }
}
