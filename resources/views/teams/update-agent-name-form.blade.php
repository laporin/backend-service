<x-jet-form-section submit="updateAgentName">
    <x-slot name="title">
        {{ __('Agent Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The agent\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Agent Owner Information -->
        <div class="col-span-6">
            <x-jet-label value="{{ __('Agent Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $agent->owner->profile_photo_url }}" alt="{{ $agent->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $agent->owner->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $agent->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Agent Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Agent Name') }}" />

            <x-jet-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $agent)" />

            <x-jet-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $agent))
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    @endif
</x-jet-form-section>
