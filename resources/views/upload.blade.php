@extends('layouts.nav')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class='form_upload'>
{{ Form::open(array('url' => 'videos','files'=>true)) }}
    

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        <textarea name='description'></textarea>
    </div>

    <div class="form-group">
        Category:<br>
       <select name='category'>
       <option value="action">Action</option>
       <option value="comedy">Comedy</option>
       <option value="drama">Drama</option>
       <option value="science">Science Fiction</option>
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

    {{ Form::submit('Upload', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
</div>
@endsection



