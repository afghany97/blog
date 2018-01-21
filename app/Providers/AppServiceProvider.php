<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        view()->composer('layouts.side',function($view){
        
            $view->with(['archives' => \App\Post::archives() , 'tags' => \App\Tag::latest()->get()]);
        });
       
       view()->composer('posts.create',function($view){

            $view->with(['tags' => \App\Tag::latest()->get()]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
