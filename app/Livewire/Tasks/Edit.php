<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\TaskCategory;
class Edit extends Component
{
    use WithFileUploads;
    public Task $task;

    #[Validate('required|string|max:255', 'min:3')]
    public string $name ; 
    #[Validate('nullable|boolean')]
    public bool $is_completed;

    #[Validate('nullable|date_format:Y-m-d')]
    public null|string $due_date = null;

    #[Validate('nullable|file|max:2048')]
    public $media;

    public function mount(Task $task) : void
    {
        $this->task = $task;
        $this->task->load('media');
        $this->name = $task->name;
        $this->is_completed = $task->is_completed;
        $this->due_date = $task->due_date?->format('Y-m-d');
    }

    public function save()
    {
        $this->validate();

        $this->task->update([
            'name' =>$this->name ,
            'is_completed' =>$this->is_completed,
            'due_date' => $this->due_date,
        ]);
        $this->task->taskCategories()->sync($this->selectedTaskCategories ?? []);

        if($this->media){
            $this->task->getFirstMedia()?->delete();
            $this->task->addMedia($this->media)->toMediaCollection('tasks');

            

        }


        session()->flash('success','Task Updated Successfuly');

        $this->redirectRoute('tasks.index');
    }

    public function render()
    {
        return view('livewire.tasks.edit',
    [
        'taskCategories' => TaskCategory::all(),
    ]
    );
    }
}
