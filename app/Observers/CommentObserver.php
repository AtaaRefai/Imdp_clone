<?php

namespace App\observers;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentObserver
{
    /**
     * Listen to the Video created event.
     *
     * @param  Video  $video
     * @return void
     */
    public function creating(Comment $comment)
    {  
        $comment->created_by = Auth::id();
        $comment->updated_by = Auth::id();

    }
    

    /**
     * Listen to the Video deleting event.
     *
     * @param  Video  $video
     * @return void
     */
    public function deleting(Comment $comment)
    {
        
        $comment->deleted_by = Auth::id();
        $comment->save();

    }
    

    /**
     * Listen to the Videor deleting event.
     *
     * @param  Video  $video
     * @return void
     */
    public function updating(Comment $comment)
    {
        
        $comment->updated_by = Auth::id();

    }
    
   
}