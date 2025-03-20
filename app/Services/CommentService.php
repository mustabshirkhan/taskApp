<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Services\NotificationService;
use App\Notifications\NewCommentNotification;

class CommentService extends BaseService
{
    public function __construct(
        protected CommentRepository $commentRepository,
        protected NotificationService $notificationService
    )
    {
        parent::__construct($commentRepository);

    }

    public function getAllCommentsForTask($taskId)
    {
        return $this->repository->getAllCommentsForTask($taskId);
    }

    public function store(array $data)
    {
        $comment = $this->commentRepository->create([
            'task_id' => $data['task_id'],
            'user_id' => auth()->id(),
            'content' => $data['content'],
        ]);

        // send Notification via service
        $taskAuthor = $comment->task->creator;
        if($taskAuthor->id !== auth()->id()){
            $this->notificationService->sendNotification($taskAuthor, new NewCommentNotification($comment));
        }

        return $comment;
    }
    public function update($commentId, array $data)
    {
        $comment = $this->commentRepository->findById($commentId);
        $updatedComment = $this->commentRepository->update($comment, ['content' => $data['content']]);

        // ✅ Send Notification via service
        $taskAuthor = $comment->task->creator;
        if($taskAuthor->id !== auth()->id()){

            $this->notificationService->sendNotification($taskAuthor, new NewCommentNotification($updatedComment));
        }

        return $updatedComment;
    }
}
