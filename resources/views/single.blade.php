@extends('layouts.nav')
@section('content')
<div class="row">
                
                <div class="span6">
                    <h2>{{$video->title}}</h2>
                    <p>{{$video->description}}</p>
                    <video width="320" height="240" controls>
                    <source src="\uploads\{{$video->video}}" type="video/mp4">
                    </video>
                     @if(Auth::check() && Auth::user()->isAdmin())
                     
                     	
             <div class="dropdown">
                <a   href="#" data-toggle="modal" data-target="#myModal">Update</a>
                <a   href="#" data-toggle="modal" data-target="#myModal2">Delete</a>

             </div>
             
                     
                @endif

               </div>


</div>
<br>
    <div class="span4 sidebar page-sidebar "><!-- Begin sidebar column -->

            <!--Tabbed Content-->
            <h5 class="title-bg">More Info</h5>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#comments" data-toggle="tab">Comments</a></li>
                <li><a href="#about" data-toggle="tab">Cast</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="comments">
                     <ul>
                     @foreach($comments as $comment)
                        <li><i class="icon-comment"></i>{{$comment->uname}} <a href="#">{{$comment->comment}}</a>

                        @if(Auth::id()==$comment->created_by)
                        <span class='cud'>
                        <a   href="#" class='cAnch' data-toggle="modal" data-target="#myModal3" 
                         id='{{$comment->id}}' placeholder='{{$comment->comment}}' ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        
                        <a   href="#" class='cAnch'  data-toggle="modal" data-target="#myModal4" 
                        id='{{$comment->id}}'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </span>
                        @endif
                        </li>
                      @endforeach
                    </ul>
                </div>
                <div class="tab-pane" id="about">
                    <p>Enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.</p>

                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                </div>
                <div class="pagination">
                         {{$comments->render()}}
   
                </div>

            </div>
            <br>
            {{ Form::open(array('url' => 'comments/','method'=>'POST')) }}
            <div class="form-group">    
            {{ Form::text('comment', Input::old('comment')) }}
            <input name='vid' value='{{$video->id}}' hidden>
            <br>
            {{ Form::submit('Add ') }}
            </div>
            {{ Form::close() }}

        </div>


      <!-- -------------------------------------------------------------------------------------- -->

   <!-- Modal -->
             <div class="modal fade" id="myModal" role="dialog">
               <div class="modal-dialog">
    
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Update Trailer Info</h4>
                    </div>
     <div class="modal-body">
   {{ Form::open(array('url' => 'videos/'.$video->id,'method'=>'PATCH','files'=>true)) }}    

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        <input type='text' name='title' placeholder="{{$video->title}}">
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        <textarea name='description' placeholder="{{ $video->description }}"></textarea>
    </div>

    <div class="form-group">
        Category:<br>
       <select name='category'>
       <option value="action"{{$video->category=='action'?'selected="selected"' : ''}}>Action</option>
       <option value="comedy"{{$video->category=='comedy'?'selected="selected"' : ''}}>Comedy</option>
       <option value="drama" {{$video->category=='drama'?'selected="selected"' : ''}}>Drama</option>
       <option value="science"{{$video->category=='science'?'selected="selected"' : ''}}>Science Fiction</option>
       </select>
       <br><br>
    </div>
    <div class="form-group">
     <label>Select a <span class="highlight">trailer</span> to upload:</label>
      {{Form::file('video')}} 
    </div><br>
    <div class="form-group">
     <label>Select a <span class="highlight">snapshot</span> to upload:</label>
      {{Form::file('image')}} 
    </div><br>

    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
                    </div>
     
                 </div>
      
                </div>
              </div>
  

   <div class="modal fade" id="myModal2" role="dialog">
               <div class="modal-dialog">
    
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Delete Trailer </h4>
                    </div>
     <div class="modal-body">
     {{ Form::open(array('url' => 'videos/'.$video->id,'method'=>'DELETE')) }}    
     <div class="form-group">
     {{ Form::label('title', 'Do you want to delete this movie trailer?') }}

     {{ Form::submit('Delete', array('class' => 'btn btn-primary')) }}

     {{ Form::close() }}
     </div>
     </div>
      
     </div>
   </div>

  </div>

<div class="modal fade" id="myModal3" role="dialog">
               <div class="modal-dialog">
    
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Comment </h4>
                    </div>
     <div class="modal-body">
     {{ Form::open(array('name' => 'ecomment','method'=>'PATCH')) }}       
     <div class="form-group">
     <label value='Comment'></label>
     <input name='comment' id='comment'>
     <br><br>
     {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
     </form>
       </div>
     </div>
      
     </div>
   </div>
</div>

<div class="modal fade" id="myModal4" role="dialog">
               <div class="modal-dialog">
    
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Comment </h4>
                    </div>
     <div class="modal-body">
     {{ Form::open(array('name' => 'dcomment','method'=>'DELETE')) }}       
     <div class="form-group">
     <p> Do you want to delete this Comment?</p>
     <br><br>
     {{ Form::submit('Delete', array('class' => 'btn btn-primary')) }}
     </form>
       </div>
     </div>
      
     </div>
   </div>
</div>

<script>
$(".cAnch").click(function () {

    document.ecomment.action = 'http://localhost:8000/comments/'+ $(this).attr('id');
    document.getElementById('comment').placeholder = $(this).attr('placeholder');
    document.dcomment.action = 'http://localhost:8000/comments/'+$(this).attr('id');

});



</script>




@endsection
