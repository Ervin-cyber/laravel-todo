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
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("Hello from add Terminal");
        ToDo::create($request->all());
        return redirect('/');
    }
    public function save(ToDoRequest $request)
    {
        ToDo::where('id', $request->only('id'))
            ->update(['title' => $request->get('title'), 'description' => $request->get('description'), 'priority' => $request->get('priority')]);
        return redirect('/');
    }
    public function edit(ToDo $todo)
    {
        $todos = ToDo::all();
        return view('welcome', compact('todos'));
    }
    public function delete($id)
    {
        ToDo::find($id)->delete();
        return redirect('/');
    }
    public function completed($id)
    {
        ToDo::where('id', $id)
            ->update(['status' => 'Completed']);
        return redirect('/');
    }
}
