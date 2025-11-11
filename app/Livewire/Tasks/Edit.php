<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Edit extends Component
{

    public Task $task;

    #[Validate('required|string|max:255', 'min:3')]
    public string $name ; 
    #[Validate('nullable|boolean')]
    public bool $is_completed;

    public function mount(Task $task) : void
    {
        $this->task = $task;
        $this->name = $task->name;
        $this->is_completed = $task->is_completed;
    }

    public function save()
    {
        $this->validate();

        $this->task->update([
            'name' =>$this->name ,
            'is_completed' =>$this->is_completed
        ]);

        session()->flash('success','Task Updated Successfuly');

        $this->redirectRoute('tasks.index');
    }

    public function render()
    {
        return view('livewire.tasks.edit');
    }
}
