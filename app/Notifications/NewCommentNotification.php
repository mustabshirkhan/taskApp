<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;
use App\Models\Comment;

class NewCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $comment;
    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("New Comment on Your Task: {$this->comment->task->title}")
            ->greeting("Hello,")
            ->line("A new comment has been added to your task: **{$this->comment->task->title}**")
            ->line("**Comment:** {$this->comment->content}")
            ->line("**By:** {$this->comment->user->name}")
            ->action('View Task', url("/tasks/{$this->comment->task->id}"))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->comment->task->id,
            'task_title' => $this->comment->task->title,
            'comment' => $this->comment->content,
            'comment_author' => $this->comment->user->name,
        ];
    }
}
