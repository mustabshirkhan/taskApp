<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use App\Http\Requests\API\V1\Comment\StoreCommentRequest;
use App\Http\Requests\API\V1\Comment\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Task;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(Task $task)
    {
        return CommentResource::collection($this->commentService->getAllCommentsForTask($task->id));
    }

    public function store(StoreCommentRequest $request, $taskId)
    {
        $comment = $this->commentService->store([
            'task_id' => $taskId,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return new CommentResource($comment);
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function update(UpdateCommentRequest $request, $commentId)
    {
        $updatedComment = $this->commentService->update($commentId, $request->validated());
        return new CommentResource($updatedComment);
    }

    public function destroy($commentId)
    {
        $this->commentService->delete($commentId);
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}
