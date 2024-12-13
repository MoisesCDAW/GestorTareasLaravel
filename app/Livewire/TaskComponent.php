<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskComponent extends Component
{
    public $user;
    public $tasks = [];
    public $modal = false;
    public $modalCompartir = false;
    public $id;
    public $title;
    public $descripcion;
    public $editarTask = null;
    public $usuarios;
    public $user_id;
    public $permisos;

    public function render()
    {
        return view('livewire.task-component');
    }

    public function mount(){
        // $this->usuarios = User::all();
        $this->usuarios = User::where('id', '!=', auth()->user()->id)->get();
        $this -> user = Auth::user()->name;
        // $this -> tasks = Auth::user()->tasks;
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

    public function compartirTarea(){
        $user = User::find($this->user_id);
        $user->compartirTareas()->attach($this->editarTask->id, ["permisos" => $this->permisos]);
        $this->clearFields();
        $this->closeModal();
        $this->getTarea();
    }

    public function abrirCompartir(Task $task){
        $this->editarTask = $task;
        $this->modalCompartir = true;
    }

    public function cerrarCompartir(Task $task){
        $this->modalCompartir = false;
    }



    public function getTarea(){
        
        $tasks = Auth::user()->tasks;
        $compartida = Auth::user()->compartirTareas()->get();
        $this->tasks = $compartida->merge($tasks);
    }

    public function crearTareaModal(){
        if ($this->editarTask->id) {
            $task = Task::find($this->editarTask->id);
            $task->update(
                [
                    'title' => $this->title,
                    'descripcion' => $this->descripcion
                ]
            );
        }else {
            Task::create(
                [
                    'user_id' => Auth::id(),
                    'title' => $this->title,
                    'descripcion' => $this->descripcion
                ]
            );
        }


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
