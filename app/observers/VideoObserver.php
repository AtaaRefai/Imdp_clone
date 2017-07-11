<?php

namespace App\observers;
use Illuminate\Support\Facades\Auth;
use App\Video;
use Mail;
use App\User;

class VideoObserver
{
    /**
     * Listen to the Video created event.
     *
     * @param  Video  $video
     * @return void
     */
    public function creating(Video $video)
    {   
        $video->created_by= Auth::id();

    }

    /**
     * Listen to the Video deleting event.
     *
     * @param  Video  $video
     * @return void
     */
    public function deleting(Video $video)
    {   
        $video->deleted_by = Auth::id();
        $video->save();
        Mail::raw('Just deleted a trailer', function ($message) {
            $id=Auth::id();
            $user=User::find( $id);
            $message->to($user->email);
        });


    }

    /**
     * Listen to the Videor deleting event.
     *
     * @param  Video  $video
     * @return void
     */
    public function updating(Video $video)
    {
        
        $video->updated_by = Auth::id();

    }
   
}