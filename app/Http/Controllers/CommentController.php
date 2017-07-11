<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Comment;
use App\User;
use App\Http\HomeController;
use App\Http\Requests\UpdateComment ;
use Lang;



class CommentController extends Controller
{   
    public function __construct()
    {
    $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
            $comment = new Comment;
            $comment->vid = request()->vid;
            $comment->comment =request()->comment;
            $user=User::findOrFail(Auth::id());
            $comment->save();

            // redirect
            $m=Lang::get('locale.addedcomment');
            Session::flash('message', $m);
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComment $request,$id)
    {
            // store
            $comment =Comment::findOrFail($id);  
            request()->comment!==null? $comment->comment = request()->comment:'';
            $comment->save();

            // redirect
            $m=Lang::get('locale.updatedcomment');
            Session::flash('message', $m);
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateComment $request,$id)
    {

        try
           {
           $comment = Comment::findOrFail($id);
           $comment->delete();
             // redirect
           $m=Lang::get('locale.deletedcomment');
           Session::flash('message', $m);
           return redirect()->back();
           }
           // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
             {
             dd($e);
             }
    }


}
