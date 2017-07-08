<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Imdp_Clone</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS
================================================== -->
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/bootstrap-responsive.css">
<link rel="stylesheet" href="/css/prettyPhoto.css" />
<link rel="stylesheet" href="/css/custom-styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="css/style-ie.css"/>
<![endif]--> 

<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="/img/favicon.ico">
<link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">

<!-- JS
================================================== -->
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jquery.prettyPhoto.js"></script>
<script src="/js/jquery.quicksand.js"></script>
<script src="/js/jquery.custom.js"></script>


</head>

<body>
  <div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>
    
    <div class="container main-container">
    
      <div class="row header"><!-- Begin Header -->
      
        <!-- Logo
        ================================================== -->
        <div class="span5 logo">
          <a href="index.htm"><img src="/img/piccolo-logo.png" alt="" /></a>
            <h5>Love Movies... Love Piccolo</h5>
        </div>
        
        <!-- Main Navigation
        ================================================== -->
        <div class="span7 navigation">
            <div class="navbar hidden-phone">
            
            <ul class="nav">
           <li><a href="#" class='active'>{{ Auth::user()->name}}</a></li>
           <li><a href="{{URL::to('home')}}" >Home</a></li>
           @if(Auth::check() && Auth::user()->isAdmin())
           <li><a href="{{URL::to('videos/create')}}" >Upload</a></li>
           @endif


             <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="gallery-4col.htm">Categories <b class="caret"></b></a>
                <ul class="dropdown-menu">
              
                    <li><a href="{{route('home', ['category' => 'action'])}}">Action movies</a></li>
                    <li><a href="{{route('home', ['category' => 'comedy'])}}">Comedy movies</a></li>
                    <li><a href="{{route('home', ['category' => 'drama'])}}">Drama movies</a></li>
                    <li><a href="{{route('home', ['category' => 'science'])}}">Science Fiction movies</a></li>
                </ul>
             </li>

             <li><a href="{{URL::to('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    Logout</a></li>
            </ul>

              <form id="logout-form" action="{{URL::to('logout')}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
              </form>
           
            </div>

       

        </div>
   
      </div><!-- End Header -->

       <!-- Page Content
    ================================================== --> 
    <div class="row">
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('alert'))
    <div class="alert alert-danger">{{ Session::get('alert') }}</div>
    @endif
    @yield('content')
    </div><!-- End container row -->

</div> <!-- End Container -->

    <!-- Footer Area
        ================================================== -->
  <div class="footer-container"><!-- Begin Footer -->
      <div class="container">
          <div class="row footer-row">
                <div class="span3 footer-col">
             
            <div class="row"><!-- Begin Sub Footer -->
                <div class="span12 footer-col footer-sub">
                    <div class="row no-margin">
                        <div class="span6"><span class="left">Copyright 2017 Piccolo Theme. All rights reserved.</span></div>
                        <div class="span6">
                            <span class="right">
                            <a href="#">Home</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#">Features</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#">Gallery</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#">Blog</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#">Contact</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- End Sub Footer -->

        </div>
    </div><!-- End Footer -->
    </div>

    <!-- Scroll to Top -->  
    <div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>
    
</body>
</html>
