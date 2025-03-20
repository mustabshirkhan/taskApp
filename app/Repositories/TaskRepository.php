<?php
namespace App\Repositories;

use App\Models\Task;
class TaskRepository extends BaseRepository
{
    public function __construct(Task $task)
    {
        parent::__construct($task);
    }

    public function createTask(array $data)
    {
        $data['created_by'] = auth()->id(); // ✅ Set created_by at repository level
        return $this->create($data);
    }
}
