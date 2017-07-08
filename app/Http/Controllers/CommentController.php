<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Comment;
use App\Http\HomeController;
use App\Http\Requests\UpdateComment ;



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
    public function store(Request $request)
    {
            $comment = new Comment;
            $comment->vid = $request->input('vid');
            $comment->comment =$request->input('comment');
            $comment->uname= Auth::user()->name;// i save the user name to have dirict access to it in the view, and the user id is already saved automaticly by the observer in the field "created_by"
            $comment->save();

            // redirect
            Session::flash('message', 'Successfully added a Comment!');
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
    public function update($id)
    {
            // store
            $comment =Comment::find($id);  
            $request->input('comment')!==null? $comment->comment = $request->input('comment'):'';
            $comment->save();

            // redirect
            Session::flash('message', 'successfuly updated comment ');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try
           {
           $comment = Comment::findOrFail($id);
           $comment->delete();
             // redirect
           Session::flash('message', 'Successfuly deleted a comment  ');
           return redirect()->back();
           }
           // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
             {
             dd($e)
             }
    }


}
