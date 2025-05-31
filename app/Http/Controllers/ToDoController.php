<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDoRequest;
use App\Models\ToDo;
use Log;

class ToDoController extends Controller
{
    public function getAll()
    {
        $todos = ToDo::all();
        return view('welcome', compact('todos'));
    }
    public function add(ToDoRequest $request)
    {
        ToDo::create($request->all());
        return redirect('/');
    }
    public function save(ToDoRequest $request)
    {
        ToDo::where('id', $request->only('id'))
            ->update(['title' => $request->get('title'), 'description' => $request->get('description')]);
        return redirect('/');
    }
    public function edit(ToDo $todo)
    {
        //$todo->update(['title' => $validatedRequest->only('title'), 'description' => $validatedRequest->only('description'), 'priority' => $validatedRequest->only('priority'), 'status' => $validatedRequest->only('status')]);
        $todos = ToDo::all();
        return view('welcome', compact('todos'));
    }
    public function delete($id)
    {
        ToDo::find($id)->delete();
        return redirect('/');
    }
    public function markAsCompleted(ToDo $todo)
    {
        $todo->update(['status' => 'Completed']);
        return redirect('/');
    }
}
