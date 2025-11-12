<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\TaskCategory;
use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use withPagination;

    #[Url(as: 'categories', except: '')]
    public ?array $selectedTaskCategories = [];

    public function deleteTask(int $id): void
    {
        Task::findOrFail($id)->delete();

        session()->flash('message', 'Task deleted successfully');
    }

    public function render()
    {
        $tasks = Task::query()
            ->with('media', 'taskCategories')
            ->when($this->selectedTaskCategories, function (Builder $query) {
                $query->whereHas('taskCategories', function (Builder $query) {
                    $query->whereIn('task_categories.id', $this->selectedTaskCategories);
                });
            })
            ->paginate(3);
    
        $taskCategories = TaskCategory::all();
    
        return view('livewire.tasks.index', [
            'tasks' => $tasks,
            'taskCategories' => $taskCategories,
        ]);
    }
    
}
