<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::with('project')->where("user_id", auth()->id())->get();
        return response()->json($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            "project_id" => "required|exists:projects,id",
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            "status" => "required|in:pending,in_progress,completed",
            'due_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $data["project_id"] = $request->project_id;
        $data["name"] = $request->name;
        $data["description"] = $request->description;
        $data["status"] = $request->status;
        $data["due_date"] = $request->due_date;
        $data["user_id"] = auth()->id();

        $task = Task::create($data);

        return response()->json($task, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $task = Task::with('project')->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $task = Task::with('project')->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }


        $validator = Validator::make($request->all(), [
            "project_id" => "required|exists:projects,id",
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            "status" => "required|in:pending,in_progress,completed",
            'due_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        
        $task->update($request->all());

        return response()->json($task, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);  
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
