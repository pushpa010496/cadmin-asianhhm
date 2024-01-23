@extends('../layouts/app')

@section('header')
<div class="container">
<div class="page-header">
  <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Webinar / Edit #{{$webinar->id}}</h3>
</div>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row well well-sm">
      {!! Form::model($webinar, ['url' => URL::to('webinars/' . $webinar->id), 'method' => 'put','files'=> true]) !!}
     @csrf 


    <div class="">
      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'Title:') !!}
        {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('speaker', 'has-error')}}">
        {!! Form::label('speaker', 'Speaker:') !!}
        {{ Form::input('text', 'speaker', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('speaker', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('speaker_designation', 'has-error')}}">
        {!! Form::label('speaker_designation', 'Speaker Designation:') !!}
        {{ Form::input('text', 'speaker_designation', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('speaker_designation', ':message') }}</span>     
      </div>
    </div>


    <div class="">
      <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
        {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
        {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
        {!! Form::label('alt_tag', 'Image Alt Tag:') !!}
        {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>     
      </div>    
    </div>


    <div class="">
      <div class="form-group {{ $errors->first('image', 'has-error')}}">
        {!! Form::label('image', 'Image :') !!}
        {!! Form::file('image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('image', ':message') }}</span>     
      </div>
       @if($webinar->image)
        <a href="{{ config('app.url').'webinars/'.$webinar->image}}" target="_blank">view image</a>
      @endif
    </div>  
   
    <div class="">
      <div class="form-group {{ $errors->first('webinar_date', 'has-error')}}">
        {!! Form::label('webinar_date', 'Webinar Date :') !!}
        {{ Form::input('date', 'webinar_date', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('webinar_date', ':message') }}</span>     
      </div>    
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('date', 'has-error')}}">
        {!! Form::label('date', 'Date for list:') !!}
        {{ Form::input('text', 'date', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('date', ':message') }}</span>     
      </div>    
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('url', 'Webinar URL:') !!}
        {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('url', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('view_name', 'has-error')}}">
        {!! Form::label('view_name', 'Webinar file name:') !!}
        {{ Form::input('text', 'view_name', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('view_name', ':message') }}</span>     
      </div>
    </div>


   <div class="">
    <div class="form-group  {{ $errors->first('active_flag', 'has-error')}}">
      {!! Form::label('active_flag', 'Status:') !!}
      {{ Form::select('active_flag', ['1'=>'Active','0'=>'In Active'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
      <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span>     
    </div>
  </div>
  

  <div class="col-md-12">
    <div class="form-group mt-20">
      <button type="submit" class="btn btn-sm btn-primary">Save</button>
      <a class="btn btn-sm btn-default pull-right" href="{{ route('advisorboard.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
    </div>
  </div>

  {!! Form::close() !!}
</div>
</div>

</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endsection