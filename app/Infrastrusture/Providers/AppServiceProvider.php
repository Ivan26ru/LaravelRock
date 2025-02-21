<?php

namespace App\Infrastrusture\Providers;

use App\Domain\Models\Post\Post;
use App\Domain\Models\User;
use App\Domain\Repositories\PostsRepositoryInterface;
use App\Domain\Repositories\UsersRepositoryInterface;
use App\Infrastrusture\Eloquent\Repositories\PostsRepository;
use App\Infrastrusture\Eloquent\Repositories\UsersRepository;
use App\Policies\PostPolicy;
use App\Telegram\Commands\RunBot;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Простой биндинг интерфейса к реализации
         * Можно передать коллбэк, можно название другого сервиса.
         * Коллбэк будет вызываться каждый раз при запросе сервиса.
         *
         * Здесь сервис PostsRepository::class Laravel уже зарегистрировал автоматически,
         * поэтому мы просто привязываем к нему интерфейс.
         */
        $this->app->bind(PostsRepositoryInterface::class, PostsRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Post::class, PostPolicy::class);

//        Gate::define('post-create', function (User $user) {
//            return $user->id < 5;
//        });
//
        Gate::define('post-update', function (User $user) {
            request()->route('postId');
        });


//        Gate::define('edit-settings', function (User $user) {
//            return $user->isAdmin;
//        });
//
//        Gate::define('post-update', function (User $user, Post $post) {
//            return $user->id === $post->user_id;
//        });


        Gate::define('access', function (?User $user, string ...$permissions) {
            if ($user === null) {
                return false;
            }
            //            if ($user->is_admin) {
            //                return true;
            //            }

            foreach ($permissions as $permission) {
                if ($user->hasPermission($permission)) {
                    return true;
                }
            }
            return false;
        });
    }
}
