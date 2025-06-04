<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDoRequest;
use App\Models\ToDo;
use DB;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function getAll(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        $query = DB::table('to_dos')->select();
        if ($request->has('search') && strlen($request->get('search')) > 0) {
            $out->writeln("has search");
            $query->where('title', 'like', "%" . $request->get('search') . "%")
                ->orWhere('description', 'like', "%" . $request->get('search') . "%");
        }
        if ($request->has('priority') && strlen($request->get('priority')) > 0) {
            $query->where('priority', 'like', $request->only('priority'));
        }
        if ($request->has('status') && strlen($request->get('status')) > 0) {
            $out->writeln("has status");
            $query->where('status', 'like', $request->only('status'));
        }
        if ($request->has('dateFrom') && strlen($request->get('dateFrom')) > 0) {
            $out->writeln("has dateFrom or dateTo");
            $query->where('created_date', '>=', $request->only('dateFrom'));
        }
        if ($request->has('dateTo') && strlen($request->get('dateTo')) > 0) {
            $out->writeln("has dateFrom or dateTo");
            $query->where('created_date', '<=', $request->only('dateTo'));
        }

        $todos = $query->get();
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
    public function random()
    {
        ToDo::factory(5)
            ->state(new Sequence(
                ['status' => 'Completed'],
                ['status' => 'In progress'],
            ))
            ->state(new Sequence(
                ['priority' => 'P0 (high)'],
                ['priority' => 'P1 (medium)'],
                ['priority' => 'P2 (low)'],
            ))
            ->create();
        return redirect('/');
    }
}
