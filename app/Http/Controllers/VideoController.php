<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\StoreVideo ;
use Image; 
use App\Video;
use App\Comment;

use App\Http\HomeController;




class VideoController extends Controller
{   
  public function __construct()
    {

    //$this->middleware('admin');
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
    public function store(Request $request,StoreVideo $req )
    {
          
            $file = $request->video;
            $AllowedExt = array("mov", "mp4", "3gp", "ogg");
            $extension = $file->getClientOriginalExtension();
            if(!in_array($extension, $AllowedExt))
            {
             Session::flash('alert', 'check video type!');
             return redirect()->action('VideoController@create');
            }
            $filename = time().Auth::id().$file->getClientOriginalName();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);

            $image = $request->image;
            $AllowedExs = array("jpg", "jpeg", "gif", "png");
            $extension=  $image->getClientOriginalExtension();
            if(!in_array($extension, $AllowedExs))
            {
                  Session::flash('alert', 'check image type!');
                  return redirect()->action('VideoController@create');
            }
            $filename2  = time().Auth::id().'.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/'. $filename2);
            Image::make($image->getRealPath())->resize(400, 258)->save($path);

            $video = new Video;
            $video->video =$filename;
            $video->img = $filename2;
            $video->title = $request->title;
            $video->description = $request->description ;
            $video->category = $request->category;
        
            $video->save();

            Session::flash('message', 'new trailer was added successfully');
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
        $video= Video::find($id);
        $comments=Comment::where('vid', $video->id )->paginate(4);
        return View('single',compact('video','comments'));
        
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
    public function update(Request $request ,$id)
    {
        $video =Video::find($id);  

        if($request->hasFile('video'))
        {
            $file = $request->video;
            $AllowedExt = array("mov", "mp4", "3gp", "ogg");
            $extension = $file->getClientOriginalExtension();
            if(!in_array($extension, $AllowedExt))
            {
                  Session::flash('message', 'check video type!');
                  return redirect()->back();  
            }
            $filename = time().Auth::id().$file->getClientOriginalName();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $filename);
            $video->video= $filename;
        }
        
        if($request->hasFile('image'))
        {
               $image = $request->image;
               $AllowedExs = array("jpg", "jpeg", "gif", "png");
               $extension=  $image->getClientOriginalExtension();
               if(!in_array($extension, $AllowedExs))
                {
                  Session::flash('message', 'check image type!');
                  return redirect()->back();
                } 
                $filename2  = time().Auth::id().'.' . $image->getClientOriginalExtension();
                $path = public_path('uploads/'. $filename2);
                Image::make($image->getRealPath())->resize(400, 258)->save($path);
                $video->img= $filename2; 

        }

              // store
        $request->title!==null ?$video->title = $request->title:'' ;
        $request->description !==null?$video->description =$request->description:'' ;
        $request->category !==null?$video->category = $request->category:'' ;

        $video->save();

        // redirect
        Session::flash('message', 'updated data successfuly');
        return redirect()->back();
               
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   try
           {
           $video = Video::findOrFail($id);
           $video->delete();
             // redirect
           Session::flash('message', 'Successfuly deleted a trailer  ');
           return redirect()->action('HomeController@index');
           }
           // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
             {
             dd($e);
             }
    }


}
