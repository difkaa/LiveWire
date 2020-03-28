<?php

namespace App\Http\Livewire;

use App\Todo;
use Livewire\Component;

class Todos extends Component
{
    // public $todos;
    public $title = '';
    // public function mount()
    // {
    //     $this->todos = auth()->user()->todos;
    // }
    public function render()
    {
        return view('livewire.todos',[
            'todos' => auth()->user()->todos
        ]);
    }

    public function addTodo()
    {
        Todo::create([
            'user_id'   => auth()->user()->id,
            'title'     => $this->title,
            'completed' => false,
        ]);
    }
}
