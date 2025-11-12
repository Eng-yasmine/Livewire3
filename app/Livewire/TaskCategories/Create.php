<?php

namespace App\Livewire\TaskCategories;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use App\Models\TaskCategory;
class Create extends Component
{

    #[Validate('required|string|max:255')]
    public $name;

    public function save()
    {
        $this->validate();
        TaskCategory::create(['name' => $this->name]);

        session()->flash('message', 'Task category created successfully');
        $this->redirectRoute('task-categories.index' ,navigate: true);
    }

    public function render()
    {
        return view('livewire.task-categories.create');
    }
}
