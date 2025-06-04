<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ToDo</title>
</head>

<style type="text/css">
    th {
        padding: 5 35px;
    }
</style>

<div style="display:flex; flex-direction: column; align-items: center; gap: 6px;">
    <h1>
        <a href="/">
            My ToDo application
        </a>
    </h1>
    @if(Request::is('todo/*'))
        <h2>Edit ToDo</h2>
        <form action="/update" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ request('todo')->id }}">
            <input type="text" name="title" placeholder="Title" value="{{ request('todo')->title }}">
            <input type="text" name="description" placeholder="Description(optional)"
                value="{{ request('todo')->description }}">
            <label for="priority">Priority</label>
            <select name="priority">
                <option></option>
                <option {{ request('todo')->priority == 'P0 (high)' ? 'selected' : '' }}>P0 (high)</option>
                <option {{ request('todo')->priority == 'P1 (medium)' ? 'selected' : '' }}>P1 (medium)</option>
                <option {{ request('todo')->priority == 'P2 (low)' ? 'selected' : '' }}>P2 (low)</option>
            </select>
            <button>Save</button>
        </form>
    @else
        <h2>Add new ToDo</h2>
        <form action="/add" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="description" placeholder="Description(optional)">
            <label for="priority">Priority</label>
            <select name="priority">
                <option>P0 (high)</option>
                <option>P1 (medium)</option>
                <option>P2 (low)</option>
            </select>
            <button>Add</button>
        </form>
    @endif
    <h2>My ToDos</h2>
    <h3>Filter by</h3>
    <form action="/" method="GET">
        <div style="display:flex; flex-direction: column; align-items: center; gap: 6px;">
            <div style="display:flex; flex-direction: row; align-items: center; gap: 6px;">
                <span>Priority</span>
                <select name="priority">
                    <option></option>
                    <option {{ request('priority') == 'P0 (high)' ? 'selected' : '' }}>P0 (high)</option>
                    <option {{ request('priority') == 'P1 (medium)' ? 'selected' : '' }}>P1 (medium)</option>
                    <option {{ request('priority') == 'P2 (low)' ? 'selected' : '' }}>P2 (low)</option>
                </select>
            </div>
            <div style="display:flex; flex-direction: row; align-items: center; gap: 6px;">
                <span>Status</span>
                <select name="status">
                    <option></option>
                    <option {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option {{ request('status') == 'In progress' ? 'selected' : '' }}>In progress</option>
                </select>
            </div>
            <div style="display:flex; flex-direction: row; align-items: center; gap: 6px;">
                <span>Created date</span>
                <label for="from">From</label>
                <input type="date" name="dateFrom" value="{{ request('dateFrom') }}"> <br>
                <label for="to">To</label>
                <input type="date" name="dateTo" value="{{ request('dateTo') }}">
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ToDo">
            <button type="submit">Filter</button>
        </div>
    </form>
    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Created date</th>
            <th>-</th>
            <th>-</th>
            <th>Status</th>
            <th></th>
        </tr>
        @foreach($todos as $todo)
            <tr>
                <th>{{ $todo->id }}</th>
                <th>{{ $todo->title }}</th>
                <th>{{ $todo->description }}</th>
                <th>{{ $todo->priority }}</th>
                <th>{{ $todo->created_date }}</th>
                <th>
                    @if($todo->status == 'In progress')
                        <form
                            action="/todo/{{ $todo->id }}&{{ $todo->title }}&{{ $todo->description ?? '' }}&{{ $todo->priority }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button>Edit</button>
                        </form>
                    @endif
                </th>
                <th>
                    <form action="/todo/{{ $todo->id }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete it?');">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </th>
                <th>
                    {{ $todo->status }}
                    @if($todo->status == 'In progress')
                        <form action="/completed/{{ $todo->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $todo->id }}">
                            <button>Mark as completed</button>
                        </form>
                    @endif
                </th>
            </tr>
        @endforeach
    </table>
</div>