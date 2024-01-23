@extends('../layouts/app')
@section('header')
<div class="container">
<div class="page-header">
  <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Advisory Board / Create </h3>
</div>
</div>
@endsection
@section('content')

<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row well well-sm">
     {!! Form::open(array('route' => 'advisorboard.store','files'=>true)) !!}

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
        {!! Form::label('image', ' Image :') !!}
        {!! Form::file('image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('image', ':message') }}</span>     
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
      <div class="form-group {{ $errors->first('home_description', 'has-error')}}">
        {!! Form::label('home_description', 'Home Description:') !!}
        {{ Form::textarea( 'home_description', null, ['class' => 'form-control','rows'=>'5']) }}
        <span class="help-block">{{ $errors->first('home_description', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group  {{ $errors->first('home_flag', 'has-error')}}">
        {!! Form::label('home_flag', 'Show on Home page:') !!}
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

      <button type="submit" class="btn btn-sm btn-primary pull-right">Create</button>
      <a class="btn btn-sm btn-default pull-left" href="{{ route('advisorboard.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>
  </div>
</form>
</div>
</div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endsection