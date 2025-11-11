<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate('required|string|max:255', 'min:3')]
    public string $name = '';

    public function save() : void
    {
        $this->validate();

        Task::create(['name' => $this->name]);

        session()->flash('message','Task created successfully');

        $this->redirectRoute(('tasks.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.tasks.create');
    }
}
