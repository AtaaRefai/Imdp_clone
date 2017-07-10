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
        {{ Form::label('title',Lang::get('locale.Title'))}}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', Lang::get('locale.Description')) }}
        <textarea name='description'></textarea>
    </div>

    <div class="form-group">
        @lang('locale.Categories')<br>
       <select name='category'>
       <option value="action">@lang('locale.Action')</option>
       <option value="comedy">@lang('locale.Comedy')</option>
       <option value="drama">@lang('locale.Drama')</option>
       <option value="science">@lang('locale.Science')</option>
       </select>
       <br><br>
    </div>
    <div class="form-group">
     <label>@lang('locale.Select')<span class="highlight">@lang('locale.Trailer')</span>@lang('locale.To')</label>
      {{Form::file('video')}} 
    </div><br>
    <div class="form-group">
     <label>@lang('locale.Select')<span class="highlight">@lang('locale.Snapshot')</span> @lang('locale.To')</label>
      {{Form::file('image')}} 
    </div><br>

    {{ Form::submit(Lang::get('locale.Upload'), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
</div>
@endsection



