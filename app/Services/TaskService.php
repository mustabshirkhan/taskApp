<?php
namespace App\Services;
use App\Repositories\TaskRepository;

class TaskService extends BaseService
{
    public function __construct(TaskRepository $taskRepository)
    {
        parent::__construct($taskRepository);
    }
}
