@extends('../layouts/app')

@section('header')
<div class="container">
<div class="page-header">
  <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Testimonials / Edit #{{$testimonial->id}}</h3>
</div>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row well well-sm">
      {!! Form::model($testimonial, ['url' => URL::to('testimonials/' . $testimonial->id), 'method' => 'put','files'=> true]) !!}
     @csrf 


    <div class="">

      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'Client Name::') !!}
        {{ Form::input('text', 'name', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title', ':message') }}</span>     
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
    <div class="form-group">
                    {!! Form::label('image', ' Image:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                     @if($testimonial->image)
                       <img width="200" src="<?php echo config('app.url'); ?>testimonials/<?php echo $testimonial->image;?>">
                     @endif
                </div>
                </div>
    <div class="">
      <div class="form-group {{ $errors->first('company', 'has-error')}}">
        {!! Form::label('company', 'Client Company:') !!}
        {{ Form::input('text', 'company', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('company', ':message') }}</span>     
      </div>    
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('designation', 'has-error')}}">
        {!! Form::label('designation', 'Designation:') !!}
        {{ Form::input('text', 'designation', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('designation', ':message') }}</span>     
      </div>    
    </div>

    <div class="">    
      <div class="form-group {{ $errors->first('description', 'has-error')}}">
        {!! Form::label('description', 'Description:') !!}
        {{ Form::textarea( 'description', null, ['class' => 'form-control','rows'=>'5']) }}
        <span class="help-block">{{ $errors->first('description', ':message') }}</span>     
      </div>
    </div>
    
  <div class="">
      <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('url', 'Testimonial URL:') !!}
        {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('url', ':message') }}</span>     
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
      <a class="btn btn-sm btn-default pull-right" href="{{ route('testimonials.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
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