<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('article-update',function(User $user, Article $article){
            return $user->id == $article->user_id ? Response::allow() : Response::deny('You are not allowed');
        });
        Gate::define('article-delete',function(User $user,Article $article){
            return $user->id == $article->user_id;
        });
//        Gate::before(function (User $user){
////            $admins = [1, 5, 7];
////            if (in_array($user->id, $admins)) {
////                return Response::allow();
////            }
//        });
        Gate::define('admin-only', function (User $user){
            return $user->role == 'admin' ? Response::allow() : Response::deny('only admin can see');
        });
    }
}
