<x-jet-action-section>
    <x-slot name="title">
        {{ __('Delete Agent') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this agent.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Once a agent is deleted, all of its resources and data will be permanently deleted. Before deleting this agent, please download any data or information regarding this agent that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="$toggle('confirmingAgentDeletion')" wire:loading.attr="disabled">
                {{ __('Delete Agent') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete Agent Confirmation Modal -->
        <x-jet-confirmation-modal wire:model="confirmingAgentDeletion">
            <x-slot name="title">
                {{ __('Delete Agent') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this agent? Once a agent is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingAgentDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteAgent" wire:loading.attr="disabled">
                    {{ __('Delete Agent') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </x-slot>
</x-jet-action-section>
