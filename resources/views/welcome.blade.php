<style type="text/css">
    th {
        padding: 5 35px;
    }
</style>

<div style="display:flex; flex-direction: column; align-items: center; gap: 6px;">
    <h1>My ToDo application</h1>
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
                <option>P0 (high)</option>
                <option>P1 (medium)</option>
                <option>P2 (low)</option>
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
    <div style="display:flex; flex-direction: row; align-items: center; gap: 6px;">
        <span>Priority</span>
        <select name="priority">
            <option></option>
            <option>P0 (high)</option>
            <option>P1 (medium)</option>
            <option>P2 (low)</option>
        </select>
        <button type="submit">Filter</button>
    </div>
    <div style="display:flex; flex-direction: row; align-items: center; gap: 6px;">
        <span>Status</span>
        <select name="status">
            <option></option>
            <option>Completed</option>
            <option>In progress</option>
        </select>
        <button type="submit">Filter</button>
    </div>
    <div style="display:flex; flex-direction: row; align-items: center; gap: 6px;">
        <span>Created date</span>
        <label for="from">From</label>
        <input type="date" name="from"> <br>
        <label for="to">To</label>
        <input type="date" name="to">
        <button type="submit">Filter</button>
    </div>
    <form>
        @csrf
        <input type="text" name="search" placeholder="Search ToDo">
        <button type="submit">Search</button>
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
                    <form action="/todo/{{ $todo->id }}&{{ $todo->title }}&{{ $todo->description ?? '' }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button>Edit</button>
                    </form>
                </th>
                <th>
                    <form action="/todo/{{ $todo->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </th>
                <th>Mark as completed</th>
            </tr>
        @endforeach
    </table>
</div>