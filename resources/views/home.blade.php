@extends('layouts.nav')
@section('content')

        <div class="span12 gallery">

             <ul id="filterOptions" class="gallery-cats clearfix">
                <li class="active"><a href="#" class="all">Box Office New Movies</a></li> 
             </ul>

            <div class="row clearfix">
                <ul class="gallery-post-grid holder">
                @foreach ($videos as $video) 
       

                    <!-- Gallery Item 1 -->
                    <li  class="span4 gallery-item" data-id="id-1" data-type="illustration">
                        <span class="gallery-hover-3col hidden-phone hidden-tablet">
                            <span class="gallery-icons">
                                <a href="img/gallery/gallery-img-1-full.jpg" class="item-zoom-link lightbox" title="Custom Illustration" data-rel="prettyPhoto"></a>
                                <a href="{{URL::to('videos/'.$video->id)}}" 
                                 class="item-details-link"></a>


                            </span>
                        </span>
                        <a href="{{URL::to('videos/'.$video->id)}}"><img src="/uploads/{{$video->img}}" alt="Gallery"></a>
                        <span class="project-details"><a href="{{URL::to('videos/'.$video->id)}}">
                        {{$video->title}}</a>Category: {{$video->category}}</span>
                    </li>

                @endforeach 


                </ul>
            </div>
           

            <div class="pagination">
                         {{$videos->render()}}
   
            </div>

        </div><!-- End gallery list-->

    
    
@endsection
