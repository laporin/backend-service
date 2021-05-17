<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agent Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('agents.update-agent-name-form', ['agent' => $agent])

            @livewire('agents.agent-member-manager', ['agent' => $agent])

            @if (Gate::check('delete', $agent) && ! $agent->personal_agent)
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('agents.delete-agent-form', ['agent' => $agent])
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
