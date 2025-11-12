<section>

<x-alerts.success />

<div class="flex flex-grow gap-x-4 mb-4">
    <flux:button wire:navigate href="{{ route('task-categories.create') }}" variant="filled">
        {{ __('Create Task') }}
    </flux:button>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
               

                <th scope="col" class="px-6 py-3">
                    Category Name
                </th>

                <th scope="col" class="px-6 py-3">
                    Tasks Count
                </th>

                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taskCategories as $taskCategory)
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $taskCategory->name }}
                    </th>
                    <td class="px-6 py-4">
                        <span @class([
                            'text-green-600' => $taskCategory->tasks_count > 0,
                            'text-red-700' => $taskCategory->tasks_count == 0,
                        ])>
                            {{ $taskCategory->tasks_count > 0 ? 'Has tasks' : 'No tasks' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <flux:button href="{{ route('task-categories.edit', $taskCategory) }}" variant="filled">{{ __('Edit') }}</flux:button>
                        <flux:button wire:confirm="Are you sure you want to delete this task?"
                            wire:click="deleteTaskCategory({{ $taskCategory->id }})" variant="danger" type="button">
                            {{ __('Delete') }}</flux:button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    @if ($taskCategories->hasPages())
        <div class="mt-5">
            {{ $taskCategories->links() }}
        </div>
    @endif

</div>

</section>
