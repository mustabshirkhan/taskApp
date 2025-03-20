<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepository;
use App\Repositories\TaskRepository;
use App\Repositories\CommentRepository;
use App\Services\TaskService;
use App\Services\CommentService;
use App\Services\NotificationService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repositories to interfaces (if applicable)
        $this->app->bind(BaseRepository::class, BaseRepository::class);
        $this->app->bind(TaskRepository::class, function ($app) {
            return new TaskRepository(new \App\Models\Task);
        });
        $this->app->bind(CommentRepository::class, function ($app) {
            return new CommentRepository(new \App\Models\Comment);
        });

        // Bind services
        $this->app->bind(TaskService::class, function ($app) {
            return new TaskService($app->make(TaskRepository::class));
        });

        $this->app->bind(CommentService::class, function ($app) {
            return new CommentService(
                $app->make(CommentRepository::class),
                $app->make(NotificationService::class) // ✅ Inject NotificationService
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->loadRoutesFrom(base_path('routes/api.php'));
    }
}
