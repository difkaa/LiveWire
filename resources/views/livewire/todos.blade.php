<div>
    <div>
    <div class="d-flex mb-4">
            <input type="text" name="addTodo" class="form-control form-control-lg" placeholder="What needs to be done?" value="{{old('addTodo')}}" wire:model="title" wire:keydown.enter="addTodo" >
            {{-- <button class="btn btn-primary" wire:click="addTodo" type="submit">send</button> --}}
     </div>
        <ul class="list-group">
            @foreach ($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <input type="checkbox" class="mr-4">
                        <a href="#" class="">{{$todo->title}}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
