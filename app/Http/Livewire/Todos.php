<?php

namespace App\Http\Livewire;

use App\Todo;
use Livewire\Component;

class Todos extends Component
{
    // public $todos;
    public $title = '';
    public $search;
    public function mount()
    {
        // $this->todos = auth()->user()->todos;
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        return view('livewire.todos',[
            // 'todos' => auth()->user()->todos
            'todos' => Todo::where('user_id',auth()->user()->id)->where('title', 'like', '%'.$this->search.'%')->get()
        ]);
    }

    public function addTodo()
    {
        $this->validate([
            'title' => 'required'
        ]);
        Todo::create([
            'user_id'   => auth()->user()->id,
            'title'     => $this->title,
            'completed' => false,
        ]);

        $this->title='';
        session()->flash('message', 'Todo successfully created.');

    }

    public function deleteTodo($id){
        Todo::findOrFail($id)->delete();
    }

    public function toggleTodo($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function updateTodo($id, $title){
        $todo = Todo::findOrFail($id);
        $todo->title = $title;
        $todo->save();
        session()->flash('info', 'Todo successfully updated.');

    }
}
