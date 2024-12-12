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
    public $title;
    public $descripcion;

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
    }

    public function openCreatemodal() {
        $this->clearFields();
        $this->modal = true;
    }

    public function closeModal() {
        $this->modal = false;
    }

    public function getTarea(){
        $this->tasks = Auth::user()->tasks;
    }

    public function crearTareaModal(){
        Task::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'descripcion' => $this->descripcion
        ]);

        $this->closeModal();
        $this->getTarea();
    }
}
