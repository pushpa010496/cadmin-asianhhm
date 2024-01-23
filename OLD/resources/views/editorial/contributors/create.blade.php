@extends('layouts/app')

@section('header')
<div class="container">
<div class="page-header"> 
    <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Editorial Contributors/ Create </h3>
</div>
</div>
@endsection

@section('content')

@if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row  well well-sm">
      {!! Form::open(['route'=>'contributors.store','files'=>'true']) !!}

      @csrf   

    <!--   <div class="form-group {{ $errors->first('category_id', 'has-error')}}">
        {!! Form::label('category_id', 'Category:') !!}
        {{ Form::select('category_id', $categories, null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('category_id', ':message') }}</span>     
    </div>
    <div class="form-group {{ $errors->first('issue_id', 'has-error')}}">
        {!! Form::label('issue_id', 'Issue No:') !!}
        {{ Form::select('issue_id', $issues, null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('issue_id', ':message') }}</span> 
    </div>
    <div class="form-group {{ $errors->first('article_id', 'has-error')}}">
        {!! Form::label('article_id', 'Online Article Title:') !!}
        {{ Form::select('article_id', $articles, null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('article_id', ':message') }}</span> 
    </div> -->
    <div class="form-group {{ $errors->first('Author Name :', 'has-error')}}">
        {!! Form::label('Author Name', 'Author Name:') !!}
        {{ Form::input('text','title', null,['class' => 'form-control']) }}     
        <span class="help-block">{{ $errors->first('title', ':message') }}</span>                
    </div>
  
    <div class="form-group {{ $errors->first('type', 'has-error')}}">
        {!! Form::label('type', 'Type:') !!}


        {{  Form::select('type', ['1' => 'Contributors', '2' => 'Author for articles'],null,['class' => 'form-control'])    }}  
        <span class="help-block">{{ $errors->first('type', ':message') }}</span>               
    </div>
    <!-- <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
        {!! Form::label('anchor title tag', 'Anchor Title Tag:') !!}

        {{ Form::input('text','title_tag', null,['class' => 'form-control']) }} 
        <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span>   

    </div> -->

  <div class="form-group {{ $errors->first('image', 'has-error')}}">
        {!! Form::label('Author Avtar', 'Author Avtar :') !!}
        {{  Form::file('image')}}     
        <span class="help-block">{{ $errors->first('image', ':message') }}</span>                
    </div> 

    <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
        {!! Form::label('Image Alt tag', 'Image Alt Tag:') !!}
        {{ Form::input('text','alt_tag', null,['class' => 'form-control']) }}     
        <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>                
    </div>

    <div class="form-group {{ $errors->first('authorbio', 'has-error')}}">
         {!! Form::label('details', 'Details:') !!}
        {{ Form::textarea('details', null, ['class' => 'form-control','rows'=>'4']) }}  
        <span class="help-block">{{ $errors->first('details', ':message') }}</span>                   
    </div> 

        <div class="form-group {{ $errors->first('details', 'has-error')}}">
       
          {!! Form::label('authorbio', 'Author Bio:') !!}
        {{ Form::textarea('authorbio', null, ['class' => 'form-control','rows'=>'4']) }}  
        <span class="help-block">{{ $errors->first('authorbio', ':message') }}</span>                   
    </div> 

    <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('Url', 'Url:') !!}
        {{ Form::input('text','url', null,['class' => 'form-control']) }}  
        <span class="help-block">{{ $errors->first('url', ':message') }}</span>                   
    </div>


    <div class="form-group {{ $errors->first('active_flag', 'has-error')}}">
        {!! Form::label('active_flag', 'Status:') !!}


        {{  Form::select('active_flag', ['1' => 'Active', '0' => 'In Active'],null,['class' => 'form-control'])    }}  
        <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span>               
    </div>


    <div class="form-group">
        
        <input type="submit" value="Submit"  class="btn btn-primary pull-right" />
        <a href="{{ route('contributors.index') }}" class="btn btn-info pull-left" >Back</a>    

    </div>

    {!! Form::close() !!}

 </div>
</div>
</div>
@endsection

@section('scripts')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    // CKEDITOR.replace('details');
    CKEDITOR.replace('authorbio');
</script>

@endsection

