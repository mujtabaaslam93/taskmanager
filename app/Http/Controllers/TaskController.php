<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->get();
        return view('tasks.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $project_id = $request->input('project_id');
        $maxPriority = Task::where('project_id', $project_id)->max('priority') ?: 0;
        
        $task = new Task();
        $task->name = $request->input('name');
        $task->project_id = $project_id;
        $task->priority = $maxPriority + 1;  // Ensures new tasks go to the end of the list
        $task->save();
        
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $task = Task::find($request->id);
        $task->name = $request->name;
        $task->save();

        return response()->json(['status' => 'success', 'message' => 'Task updated successfully.']);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    public function reorder(Request $request)
    {
        $tasks = $request->tasks;
        foreach ($tasks as $priority => $id) {
            Task::where('id', $id)->update(['priority' => $priority + 1]);
        }
        return response()->json(['status' => 'success']);
    }
}
