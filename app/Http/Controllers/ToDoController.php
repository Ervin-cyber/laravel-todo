<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDoRequest;
use App\Models\ToDo;

class ToDoController extends Controller
{
    public function getAll()
    {
        $todos = ToDo::all();
        return view('welcome', compact('todos'));
    }
    public function add(ToDoRequest $request)
    {
        ToDo::create($request->validated());
        return redirect('/');
    }
    public function edit(ToDoRequest $request, ToDo $todo)
    {
        $validatedRequest = $request->validated();
        $todo->update(['title' => $validatedRequest->only('title'), 'description' => $validatedRequest->only('description'), 'priority' => $validatedRequest->only('priority'), 'status' => $validatedRequest->only('status')]);
        return redirect('/');
    }
    public function delete(ToDo $todo)
    {
        $todo->delete();
        return redirect('/');
    }
    public function markAsCompleted(ToDo $todo)
    {
        $todo->update(['status' => 'Completed']);
        return redirect('/');
    }
}
