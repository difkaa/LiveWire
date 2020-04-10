<div>
    <div>
    <div class="mb-4">
        <div style="text-align: right">
            <input type="text" class="mb-2" class="form-control form-control-lg" placeholder=" Type your keyword..." wire:model="search" style="text-align: left">
        </div>
            <input type="text" name="addTodo" class="form-control form-control-lg" placeholder="What needs to be done?" value="{{old('addTodo')}}" wire:model="title" wire:keydown.enter="addTodo" >
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @elseif(session()->has('info'))
                    <div class="alert alert-info">
                        {{session('info')}}
                    </div>
                @endif
            </div>
            {{-- <button class="btn btn-primary" wire:click="addTodo" type="submit">send</button> --}}
            @if($errors->has('title'))
            <div style="color:red;">{{$errors->first('title')}}</div>
            @endif
     </div>

        <table class="table table-bordered">
            <tr>
                <th style="width:15px">Check(*)
                    <input type="checkbox" class="selectall" style="text-align: center"></th>
                <th style="text-align: center">Title</th>
                <th style="text-align: center">Action</th>
            </tr>
            @foreach ($todos as $todo)
            <tr>
                <td>
                <input type="checkbox" wire:change="toggleTodo({{$todo->id}})" name="listTodo[]" class="mr-4 selectone" id="{{$todo->id}}" {{$todo->completed ? 'checked' : '' }}>
                </td>
                <td>
                    <div>
                        <a href="#"
                        class="{{ $todo->completed ? 'completed':''}}"
                        onclick="updateTodoPrompt('{{$todo->title}}') || event.stopImmediatePropagation();"
                        wire:click="updateTodo({{$todo->id}}, todoUpdated)">
                        {{$todo->title}}
                    </a>
                    </div>
                </td>
                <td>
                    <div style="text-align: center">
                        <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure delete this {{$todo->title}}?') || event.stopImmediatePropagation();"
                        wire:click="deleteTodo({{$todo->id}})">&times;</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        {{-- <ul class="list-group">
            @foreach ($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <input type="checkbox" wire:change="toggleTodo({{$todo->id}})" class="mr-4" {{$todo->completed ? 'checked' : '' }}>
                        <a href="#"
                        class="{{ $todo->completed ? 'completed':''}}"
                        onclick="updateTodoPrompt('{{$todo->title}}') || event.stopImmediatePropagation();"
                        wire:click="updateTodo({{$todo->id}}, todoUpdated)">
                        {{$todo->title}}
                    </a>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure delete this {{$todo->title}}?') || event.stopImmediatePropagation();"
                        wire:click="deleteTodo({{$todo->id}})">&times;</button>
                    </div>
                </li>
            @endforeach
        </ul> --}}
    </div>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        let todoUpdated = '';
        function updateTodoPrompt($title){
            event.preventDefault();
            console.log($title);
            todoUpdated = '';
            const todo = prompt("Update todo", $title);

            if(todo == null || todo.trim() == ''){
                todoUpdated = '';
                return false;
            }
            todoUpdated = todo;
            return true;
        }

        $(".selectall").change(function() {
            if(this.checked){
                $(".selectone"+this.id).each(function(){
                    if(!$(this).hasClass("ck_uncompleted_data"))
                    $(this).prop( "checked", true );
                });
            }
            else{
                $(".selectone"+this.id).prop( "checked", false );
                $('.selectone').prop( "checked", false );
            }
        });
    </script>
</div>
