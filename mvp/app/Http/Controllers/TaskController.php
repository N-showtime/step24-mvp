<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function taskCreate() {
        return view('task.taskcreate');
    }

    public function taskStore(Request $request) {
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'budget' => $request->budget,
            'date' => $request->date,
            'repeat_type' => $request->repeat_type,
            'day_of_week' => is_array($request->day_of_week)? implode(',', $request->day_of_week): $request->day_of_week,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date

        ]);
        $request->session()->flash('message', '保存しました');
        return back();
    }
}
