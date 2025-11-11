<section class="max-w-5xl">
<form wire:submit="save" class="flex flex-col gap-6">
    <flux:input
        wire:model="name"
        :label="__('Task Name')"
        required
        badge="required"
    />

    <flux:checkbox
        wire:model="is_completed"
        label="Completed?"
    />

    <flux:input
        wire:model="due_date"
        :label="__('Due Date')"
        type="date"
    />

    <flux:input
        wire:model="media"
        type="file"
        :label="__('Media')"
    />

    @if($task->media_file)
        <a href="{{ $task->media_file->original_url }}" target="_blank">
            <img src="{{ $task->media_file->original_url }}" alt="{{ $task->name }}" class="w-8 h-8" />
        </a>
    @endif

    <div>
        <flux:button variant="primary" type="submit">
            {{ __('Save') }}
        </flux:button>
    </div>
</form>
</section>
