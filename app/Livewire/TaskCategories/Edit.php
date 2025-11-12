<?php

namespace App\Livewire\TaskCategories;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\TaskCategory;

class Edit extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    public TaskCategory $taskCategory;

    public function mount(TaskCategory $taskCategory)
    {
        $this->taskCategory = $taskCategory;
        $this->name = $taskCategory->name;
    }

    public function save()
    {
        $this->validate();
        $this->taskCategory->update(['name' => $this->name]);

        session()->flash('message', 'Task category updated successfully');
        $this->redirectRoute('task-categories.index' ,navigate: true);
    }

    public function render()
    {
        return view('livewire.task-categories.edit');
    }
}
