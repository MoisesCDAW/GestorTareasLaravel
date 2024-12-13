<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskComponent extends Component
{
    public $user;
    public $tasks = [];
    public $modal = false;
    public $id;
    public $title;
    public $descripcion;
    public $editarTask = null;

    public function render()
    {
        return view('livewire.task-component');
    }

    public function mount(){
        $this -> user = Auth::user()->name;
        $this -> tasks = Auth::user()->tasks;
        $this -> getTarea();
    }

    public function clearFields(){
        $this->title = "";
        $this->descripcion = "";
        $this->id = "";
        $this->editarTask = null;
    }

    public function openCreatemodal(Task $task = null) {
        

        if ($task) {
            $this->title = $task->title;
            $this->descripcion = $task->descripcion;
            $this->id = $task->id;
            $this->editarTask = $task;
        }else {
            $this->clearFields();
        }

        $this->modal = true;
    }

    public function closeModal() {
        $this->modal = false;
    }

    public function getTarea(){
        $this->tasks = Auth::user()->tasks;
    }

    public function crearTareaModal(){
        Task::UpdateOrCreate(
            ['id' => $this->editarTask->id],
            [
                'user_id' => Auth::id(),
                'title' => $this->title,
                'descripcion' => $this->descripcion
            ]
        );
        $this->clearFields();
        $this->closeModal();
        $this->getTarea();
    }

    public function borrarTarea(Task $task){
        $task->delete();
        $this->clearFields();
        $this->closeModal();
        $this->getTarea();
    }
}
