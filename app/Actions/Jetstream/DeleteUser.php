<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesAgents;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * The agent deleter implementation.
     *
     * @var \Laravel\Jetstream\Contracts\DeletesAgents
     */
    protected $deletesAgents;

    /**
     * Create a new action instance.
     *
     * @param  \Laravel\Jetstream\Contracts\DeletesAgents  $deletesAgents
     * @return void
     */
    public function __construct(DeletesAgents $deletesAgents)
    {
        $this->deletesAgents = $deletesAgents;
    }

    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        DB::transaction(function () use ($user) {
            $this->deleteAgents($user);
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();
        });
    }

    /**
     * Delete the agents and agent associations attached to the user.
     *
     * @param  mixed  $user
     * @return void
     */
    protected function deleteAgents($user)
    {
        $user->agents()->detach();

        $user->ownedAgents->each(function ($agent) {
            $this->deletesAgents->delete($agent);
        });
    }
}
