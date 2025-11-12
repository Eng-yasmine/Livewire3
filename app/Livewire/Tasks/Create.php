<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\TaskCategory;
class Create extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255', 'min:3')]
    public string $name = '';

    #[Validate('nullable|date_format:Y-m-d')]
    public null|string $due_date = null;

    #[Validate('nullable|file|max:2048')]
    public $media;

    #[Validate([
        'selectedTaskCategories' => ['nullable', 'array'],
        'selectedTaskCategories.*' => ['exists:task_categories,id'],
    ])]
    public array $selectedTaskCategories = [];
    public function save() : void
    {
        $this->validate();

        $task = Task::create([
            'name' => $this->name,
            'due_date' => $this->due_date,
            'is_completed' => false,
        ]);

        $task->taskCategories()->sync($this->selectedTaskCategories);

        if($this->media){
            
                $task->addMedia($this->media)->toMediaCollection('tasks');
            }
        
        session()->flash('message','Task created successfully');

        $this->redirectRoute(('tasks.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.tasks.create',
    [
        'taskCategories' => TaskCategory::all(),
    ]
    );
    }
}
