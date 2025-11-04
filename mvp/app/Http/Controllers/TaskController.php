<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', compact('tasks')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'budget' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $task = Task::create([
             ...$validated,
            'description' => $request->description,
            'date' => $request->date,
            'repeat_type' => $request->repeat_type,
            'day_of_week' => is_array($request->day_of_week)? implode(',', $request->day_of_week): $request->day_of_week,
        ]);
        $request->session()->flash('message', '保存しました');
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'budget' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $task->update([
             ...$validated,
            'description' => $request->description,
            'date' => $request->date,
            'repeat_type' => $request->repeat_type,
            'day_of_week' => is_array($request->day_of_week)? implode(',', $request->day_of_week): $request->day_of_week,

        ]);
        $request->session()->flash('message', '更新しました');
         return redirect()->route('task.show', ['task' => $task->id]) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('task.index') ;
    }
}
