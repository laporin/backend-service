<?php

namespace App\Providers;

use App\Actions\Jetstream\AddAgentMember;
use App\Actions\Jetstream\CreateAgent;
use App\Actions\Jetstream\DeleteAgent;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteAgentMember;
use App\Actions\Jetstream\RemoveAgentMember;
use App\Actions\Jetstream\UpdateAgentName;
use App\Models\Agent;
use App\Models\AgentUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        // Jetstream::useUserModel(App\MyStuf\Models\User::class);
        Jetstream::useTeamModel(Agent::class);
        Jetstream::useMembershipModel(AgentUser::class);

        Jetstream::createTeamsUsing(CreateAgent::class);
        Jetstream::updateTeamNamesUsing(UpdateAgentName::class);
        Jetstream::addTeamMembersUsing(AddAgentMember::class);
        Jetstream::inviteTeamMembersUsing(InviteAgentMember::class);
        Jetstream::removeTeamMembersUsing(RemoveAgentMember::class);
        Jetstream::deleteTeamsUsing(DeleteAgent::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', __('Administrator'), [
            'create',
            'read',
            'update',
            'delete',
        ])->description(__('Administrator users can perform any action.'));

        Jetstream::role('editor', __('Editor'), [
            'read',
            'create',
            'update',
        ])->description(__('Editor users have the ability to read, create, and update.'));
    }
}
