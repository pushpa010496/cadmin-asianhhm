@extends('layouts/app')

@section('header')
<div class="container">
<div class="page-header"> 
    <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Editorial Article / Create </h3>
</div>
</div>
@endsection

@section('content')


<div class="row ">
  <div class="col-md-offset-3 col-md-6">
    <div class="row well well-sm"> 
      {!! Form::open(['route'=>'editorialarticle.store']) !!}

      @csrf   

      <div class="form-group {{ $errors->first('category_id', 'has-error')}}">
        {!! Form::label('category_id', 'Category:') !!}
        {{ Form::select('category_id', $categories, null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('category_id', ':message') }}</span>     
    </div>
    <div class="form-group {{ $errors->first('issue_id', 'has-error')}}">
        {!! Form::label('issue_id', 'Issue No:') !!}
        {{ Form::select('issue_id', $issues, null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('issue_id', ':message') }}</span> 
    </div>
     <div class="form-group {{ $errors->first('author_id', 'has-error')}}">
        {!! Form::label('author_id', 'Author Name:') !!}
        {{ Form::select('author_id[]', $author, null, ['class' => 'form-control','required'=>'required','multiple'=>'multiple']) }}
        <span class="help-block">{{ $errors->first('author_id', ':message') }}</span> 
    </div>
    <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'Title:') !!}
        {{ Form::input('text','title', null,['class' => 'form-control']) }}     
        <span class="help-block">{{ $errors->first('title', ':message') }}</span>                
    </div>
    <div class="form-group {{ $errors->first('sub_title', 'has-error')}}">
        {!! Form::label('sub_title', 'Sub title:') !!}
        {{ Form::input('text','sub_title', null,['class' => 'form-control']) }} 
        <span class="help-block">{{ $errors->first('sub_title', ':message') }}</span>                    
    </div> 

    <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
        {!! Form::label('anchor title tag', 'Anchor Title Tag:') !!}

        {{ Form::input('text','title_tag', null,['class' => 'form-control']) }} 
        <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span>   

    </div>

    <div class="form-group {{ $errors->first('abstract', 'has-error')}}">
        {!! Form::label('abstract', 'Abstract:') !!}
        {{ Form::textarea('abstract', null, ['class' => 'form-control','rows'=>'3']) }} 
        <span class="help-block">{{ $errors->first('abstract', ':message') }}</span>                    
    </div>
        <div class="form-group {{ $errors->first('abstract', 'has-error')}}">
        {!! Form::label('short_description', 'Short Description:') !!}
        {{ Form::textarea('short_description', null, ['class' => 'form-control','rows'=>'3']) }} 
        <span class="help-block">{{ $errors->first('short_description', ':message') }}</span>                    
    </div>
    <div class="form-group {{ $errors->first('description', 'has-error')}}">
        {!! Form::label('Main Body', 'Main Body:') !!}
        {{ Form::textarea('description', null, ['class' => 'form-control','rows'=>'4']) }}  
        <span class="help-block">{{ $errors->first('description', ':message') }}</span>                   
    </div> 
    <div class="">
      <div class="form-group  {{ $errors->first('on_home', 'has-error')}}">
        {!! Form::label('on_home', 'Show on Home page:') !!}
        {{ Form::select('on_home', ['1'=>'Show','0'=>'Hide'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
        <span class="help-block">{{ $errors->first('on_home', ':message') }}</span>     
      </div>
    </div> 

     <div class="form-group {{ $errors->first('image', 'has-error')}}">
        {!! Form::label('Image', 'Image:') !!}
        {{  Form::file('image')}}     
        <span class="help-block">{{ $errors->first('image', ':message') }}</span>                
    </div> 

    <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
        {!! Form::label('Image Alt tag', 'Image Alt Tag:') !!}
        {{ Form::input('text','alt_tag', null,['class' => 'form-control']) }}     
        <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>                
    </div>
    <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('Online Article Url', 'Online Article Url:') !!}
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
        <a href="{{ route('editorialarticle.index') }}" class="btn btn-info pull-left" >Back</a>    

    </div>

    {!! Form::close() !!}

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

