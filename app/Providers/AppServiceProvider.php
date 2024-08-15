<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

//        Gate::define('post-update',function (User $user,Post $post){
//            return $user->id === $post->user_id;
//        });

        Blade::if('manageLvl',function (){
            return !Auth::user()->isAuthor();
        });

        Blade::if('adminLvl',function (){
            return Auth::user()->isAdmin();
        });
    }
}
