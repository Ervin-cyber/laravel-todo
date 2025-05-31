<h1>My ToDos</h1>

@foreach($todos as $todo)
    {{ $todo->title }}
@endforeach