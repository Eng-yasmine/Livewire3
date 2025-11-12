<?php

namespace App\Livewire\TaskCategories;

use Livewire\Component;
use App\Models\TaskCategory;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public TaskCategory $taskCategory;

  public function delete(TaskCategory $taskCategory)
  {
    if($taskCategory->tasks->count() > 0){
        $taskCategory->tasks()->detach();
    }
    $taskCategory->delete();
  }
    public function render()
    {
        return view('livewire.task-categories.index' ,
    ['taskCategories'=>TaskCategory::withCount('tasks')->latest()->paginate(5)]);
    }
}
