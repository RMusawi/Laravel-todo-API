<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            "tasks" => $tasks
        ], 200);
    }

    public function store(Request $request)
    {
        $task = Task::create([
            "content" => $request->content,
            "completed" => false
        ]);

        return response()->json([
            "task" => $task
        ], 200);
    }

    public function delete(Request $request)
    {
        $task = Task::whereId($request->id)->first();

        if(!is_null($task)) {
            $task->delete();
        }

        return response(200);
    }

    public function complete(Request $request)
    {
        $task = Task::whereId($request->id)->first();

        if(!is_null($task)) {
            $task->completed = !$task->completed;
            $task->save();
        }

        return response(200);
    }
}