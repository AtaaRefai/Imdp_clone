<?php

namespace App\Providers;

use App\Video;
use App\Comment;

use App\Observers\VideoObserver;
use App\Observers\CommentObserver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Video::observe(VideoObserver::class);
      Comment::observe(CommentObserver::class);
      /*Comment::saving(function ($comment) {
      $comment->created_by = Auth::id(); 
      $comment->updated_by = Auth::id();        
      });
      Comment::deleting(function ($comment) {
      $comment->deleted_by = Auth::id(); 
      $comment->save();
      });
      Comment::updating(function ($comment) {
      $comment->updated_by = Auth::id(); 
      });*/

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
