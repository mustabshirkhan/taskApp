<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Comment;
class CommentRepository extends BaseRepository
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }

    public function getAllCommentsForTask($taskId)
    {
        return $this->model->where('task_id', $taskId)->get();
    }

}
