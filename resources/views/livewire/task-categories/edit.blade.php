<section class="max-w-5xl">
    <x-alerts.success />
    <form wire:submit="save" class="flex flex-col gap-6">

        <flux:input wire:model="name" :label="__('Category Name')" required badge="required" />

        <div>
            <flux:button variant="primary" type="submit">
                {{ __('Save') }}
            </flux:button>
        </div>
    </form>
</section>
