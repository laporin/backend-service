<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated as AgentCreated;
use Laravel\Jetstream\Events\TeamDeleted as AgentDeleted;
use Laravel\Jetstream\Events\TeamUpdated as AgentUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Agent extends JetstreamTeam
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'personal_agent' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'personal_agent',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => AgentCreated::class,
        'updated' => AgentUpdated::class,
        'deleted' => AgentDeleted::class,
    ];

    public function users() {
        return $this->hasManyThrough(User::class, AgentUser::class);
    }
}
