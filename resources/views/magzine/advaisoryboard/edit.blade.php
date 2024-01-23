@extends('../layouts/app')

@section('header')
<div class="container">
<div class="page-header">
  <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Advisor Board / Edit #{{$advisorboard->id}}</h3>
</div>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row well well-sm">
      {!! Form::model($advisorboard, ['url' => URL::to('advisorboard/' . $advisorboard->id), 'method' => 'put','files'=> true]) !!}
     @csrf 


    <div class="">

      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'Title:') !!}
        {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
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
       @if($advisorboard->image)
        <a href="{{ config('app.url').'advisoryboard/'.$advisorboard->image}}" target="_blank">view image</a>
      @endif
    </div>  
   
    <div class="">    
      <div class="form-group {{ $errors->first('description', 'has-error')}}">
        {!! Form::label('description', 'Description:') !!}
        {{ Form::textarea( 'description', null, ['class' => 'form-control','rows'=>'5']) }}
        <span class="help-block">{{ $errors->first('description', ':message') }}</span>     
      </div>
    </div>

    <div class="">    
      <div class="form-group {{ $errors->first('home_description', 'has-error')}}">
        {!! Form::label('home_description', 'Home Description:') !!}
        {{ Form::textarea( 'home_description', null, ['class' => 'form-control','rows'=>'5']) }}
        <span class="help-block">{{ $errors->first('home_description', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group  {{ $errors->first('home_flag', 'has-error')}}">
        {!! Form::label('home_flag', 'Show on Home :') !!}
        {{ Form::select('home_flag', ['1'=>'Show','0'=>'Hide'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
        <span class="help-block">{{ $errors->first('home_flag', ':message') }}</span>     
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