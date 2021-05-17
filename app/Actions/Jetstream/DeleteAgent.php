<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesTeams as DeletesAgents;

class DeleteAgent implements DeletesAgents
{
    /**
     * Delete the given agent.
     *
     * @param  mixed  $agent
     * @return void
     */
    public function delete($agent)
    {
        $agent->purge();
    }
}
