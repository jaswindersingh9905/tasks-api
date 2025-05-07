<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task as TaskResource;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Task::query();
        //
        // return TaskResource::collection($query->latest()->get());
        return $query->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = Task::create(
            [
                ...$request->validate([
                    'title' => 'required | max:255 |string',
                    'status_id' => 'required | int',
                    'start_date' => 'required | date',
                    'due_date' => 'required | date | after:start_date',
                    'priority' => 'required | int',
                    'description' => 'required | string | max:1000'

                ]),
                'user_id' => 1
            ]
        );
        return $task;
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update(
            $request->validate([
                'title' => 'sometimes | max:255 |string',
                'status_id' => 'sometimes | int',
                'start_date' => 'sometimes | date',
                'due_date' => 'sometimes | date | after:start_date',
                'priority' => 'sometimes | int',
                'description' => 'sometimes | string | max:1000'

            ])
        );
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response(status: 204);
    }
}
