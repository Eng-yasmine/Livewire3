<section class="max-w-5xl">
<form wire:submit="save" enctype="multipart/form-data" class="flex flex-col gap-6">

        <flux:input wire:model="name" :label="__('Task Name')" required badge="required" />

        <flux:input wire:model="due_date" :label="__('Due Date')" type="date" />

        <flux:label>Categories</flux:label>
        <ul>
            @foreach($taskCategories as $taskCategory)
                <li>
                    <input wire:model="selectedTaskCategories" type="checkbox" value="{{ $taskCategory->id }}">
                    <label>{{ $taskCategory->name }}</label>
                </li>
            @endforeach
        </ul>   
        
    <div>
    <flux:button variant="primary" type="submit">
        {{ __('Save') }}
    </flux:button>
</div>
    </form>
</section>
