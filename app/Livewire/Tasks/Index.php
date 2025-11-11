<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use withPagination;

    public function  deleteTask(int $id) : void 
    {
        Task::findOrFail($id)->delete();

        session()->flash('message','Task deleted successfully');
    }

    public function render()
    {
        return view('livewire.tasks.index' ,[
            'tasks'=>Task::with('media')->latest()->paginate(5)
        ]);
    }
}
