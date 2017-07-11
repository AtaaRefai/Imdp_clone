<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\StoreVideo ;
use App\Http\Requests\UpdateVideo ;
use Image; 
use App\Video;
use App\User;
use App\Comment;
use Lang;
use LaravelLocalization;
use App\Http\HomeController;




class VideoController extends Controller
{   
  public function __construct()
    {

    $this->middleware('admin')->except('show');


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
     return View('upload');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideo $req )
    {
          
            $file = request()->video;
            $filename = time().Auth::id().$file->getClientOriginalName();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);

            $image = request()->image;
            $filename2  = time().Auth::id().'.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/'. $filename2);
            Image::make($image->getRealPath())->resize(400, 258)->save($path);

            $video = new Video;
            $video->video =$filename;
            $video->img = $filename2;
            $video->title = request()->title;
            $video->description = request()->description ;
            $video->category = request()->category;
        
            $video->save();

            $m=Lang::get('locale.addedtrailer');
            Session::flash('message', $m);
            return redirect()->action('HomeController@index');
                

               
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $video= Video::findOrFail($id);
        $unames=[];
        $comments=Comment::where('vid', $video->id )->paginate(4);
        foreach ($comments as $comment) {
            $user=User::findOrFail($comment->created_by);
            array_push($unames,$user->name);
        }
        return View('single',compact('video','comments','unames'));
        
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
    public function update(UpdateVideo $req ,$id)
    {
        $video =Video::findOrFail($id);  

        if(request()->hasFile('video'))
        {
            $file = request()->video;
            $filename = time().Auth::id().$file->getClientOriginalName();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);
            $video->video= $filename;
        }
        
        if(request()->hasFile('image'))
        {
                $image = request()->image;
                $filename2  = time().Auth::id().'.' . $image->getClientOriginalExtension();
                $path = public_path('uploads/'. $filename2);
                Image::make($image->getRealPath())->resize(400, 258)->save($path);
                $video->img= $filename2; 
        }

        // store
        request()->title!==null ?$video->title = request()->title:'' ;
        request()->description !==null?$video->description =request()->description:'' ;
        request()->category !==null?$video->category = request()->category:'' ;

        $video->save();

        // redirect

        $m=Lang::get(LaravelLocalization::getCurrentLocale().'.locale.updatedtrailer');
        Session::flash('message', $m);
        return redirect()->back();
               
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateVideo $req,$id)
    {   try
           {
           $video = Video::findOrFail($id);
           $video->delete();
             // redirect
           $m=Lang::get('locale.deletedtrailer');
           Session::flash('message', $m);
           return redirect()->action('HomeController@index');
           }
           // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
             {
             dd($e);
             }
    }


}
