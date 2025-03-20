<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use App\Http\Requests\API\V1\Task\StoreTaskRequest;
use App\Http\Requests\API\V1\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = Task::with('comments')->get();
        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated =  $request->validated();
        $validated['created_by'] = auth()->id();

        $task = $this->taskService->create($validated);
        return new TaskResource($task);
    }

    public function show($id)
    {
        return new TaskResource($this->taskService->findById($id));
    }

    public function update(UpdateTaskRequest $request,  $taskId)
    {
        $updatedTask = $this->taskService->update($taskId, $request->validated());
        return new TaskResource($updatedTask);
    }

    public function destroy($taskId)
    {
        $this->taskService->delete($taskId);
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
