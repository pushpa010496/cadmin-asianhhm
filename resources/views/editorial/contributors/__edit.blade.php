@extends('../layouts/app')

@section('header')
<div class="container">
<div class="page-header">
  <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Contributor / Edit #{{$contributor->id}}</h3>
</div>
 </div> 
@endsection

@section('content')


<div class="row">
  <div class="col-md-offset-3 col-md-6 ">
    <div class="row well well-sm">
      {!! Form::model($contributor, ['url' => URL::to('contributors/' . $contributor->id), 'method' => 'put','files'=> true]) !!}
      @csrf 
    {{--   <div class="">
        <div class="form-group {{ $errors->first('category_id', 'has-error')}}">
          {!! Form::label('category_id', 'Category:') !!}
          {{ Form::select('category_id', $categories, $contributor->category_id, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('category_id', ':message') }}</span> 
        </div>
      </div>
      <div class="">
        <div class="form-group  {{ $errors->first('issue_id', 'has-error')}}">
          {!! Form::label('issue_id', 'Issue No:') !!}
          {{ Form::select('issue_id', $issues, $contributor->issue_id, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('issue_id', ':message') }}</span> 
        </div>
      </div>
        <div class="">
        <div class="form-group  {{ $errors->first('article_id', 'has-error')}}">
          {!! Form::label('article_id', 'Online Article Title:') !!}
          {{ Form::select('article_id', $articles, $contributor->article_id, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('article_id', ':message') }}</span> 
        </div>
      </div> --}}
      <div class="">
        <div class="form-group {{ $errors->first('title', 'has-error')}}">
          {!! Form::label('title', 'Author Name:') !!}
          {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('title', ':message') }}</span>     
        </div>
      </div>
      <div class="">
        <div class="form-group  {{ $errors->first('active_flag', 'has-error')}}">
          {!! Form::label('type', 'Type:') !!}
          {{ Form::select('type', ['1'=>'Contributors','2'=>'Author for articles'], null, ['class' => 'form-control','placeholder'=>'-- select Type -- ']) }}
          <span class="help-block">{{ $errors->first('type', ':message') }}</span>     
        </div>
      </div>

        <div class="">
        <div class="form-group {{ $errors->first('image', 'has-error')}}">
          {!! Form::label('image', 'Author Avtar :') !!}
          {!! Form::file('image', array('class' => '')) !!}
          <span class="help-block">{{ $errors->first('image', ':message') }}</span>     
        </div>
        @if($contributor->image)
        <a href="{{ config('app.url').'contributors/'.$contributor->image}}" target="_blank">view image</a>
        @endif
      </div> 
       <div class="">
        <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
          {!! Form::label('alt_tag', 'Image Alt Tag:') !!}
          {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>     
        </div>    
      </div>
       <div class="">    
        <div class="form-group {{ $errors->first('details', 'has-error')}}">
         
            {!! Form::label('details', 'Details:') !!}
          {{ Form::textarea( 'details', null, ['class' => 'form-control','rows'=>'5']) }}
          <span class="help-block">{{ $errors->first('details', ':message') }}</span>     
        </div>
      </div>
      <div class="">    
        <div class="form-group {{ $errors->first('authorbio', 'has-error')}}">
         {!! Form::label('authorbio', 'Author bio:') !!}
          {{ Form::textarea( 'authorbio', null, ['class' => 'form-control','rows'=>'5']) }}
          <span class="help-block">{{ $errors->first('authorbio', ':message') }}</span>     
        </div>
      </div>
      
{{-- 
      <div class="">
        <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
          {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
          {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span>     
        </div>
      </div>
     
       --}}
     

     
      <div class="">
        <div class="form-group  {{ $errors->first('url', 'has-error')}}">
          {!! Form::label('url', ' Url:') !!}
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
          <a class="btn btn-sm btn-default pull-right" href="{{ route('contributors.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
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
    // CKEDITOR.replace('details');
    CKEDITOR.replace('authorbio');
</script>

@endsection