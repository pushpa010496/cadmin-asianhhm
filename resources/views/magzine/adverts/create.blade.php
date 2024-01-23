@extends('../layouts/app')
@section('header')
<div class="page-header">
  <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Client Adverts / Create </h3>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-offset-1 col-md-10 col-md-offset-1">
    <div class="row well well-sm">
     {!! Form::open(array('route' => 'clientadverts.store','files'=>true)) !!}
     <div class="col-md-6">
       <div class="form-group {{ $errors->first('issue_id', 'has-error')}}">
        {!! Form::label('issue_id', 'issue no:') !!}
        {{ Form::select('issue_id', $issues, null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('issue_id', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">

      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'Title:') !!}
        {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">

      <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
        {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
        {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">

      <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
        {!! Form::label('alt_tag', 'Image Alt Tag:') !!}
        {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>     
      </div>    
    </div>
    <div class="col-md-6">
      <div class="form-group {{ $errors->first('client_advert_image', 'has-error')}}">
        {!! Form::label('client_advert_image', 'Client Advert Image :') !!}
        {!! Form::file('client_advert_image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('client_advert_image', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">

      <div class="form-group {{ $errors->first('client_advert_cover_image', 'has-error')}}">
        {!! Form::label('client_advert_cover_image', 'Client Advert Cover Image:') !!}
        {!! Form::file('client_advert_cover_image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('client_advert_cover_image', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">    
      <div class="form-group {{ $errors->first('description', 'has-error')}}">
        {!! Form::label('description', 'Description:') !!}
        {{ Form::textarea( 'description', null, ['class' => 'form-control','rows'=>'5']) }}
        <span class="help-block">{{ $errors->first('description', ':message') }}</span>     
      </div>
    </div>

    <div class="col-md-6">
    <div class="form-group  {{ $errors->first('url', 'has-error')}}">
      {!! Form::label('url', 'Client Adverts URL:') !!}
      {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
      <span class="help-block">{{ $errors->first('url', ':message') }}</span>  
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group  {{ $errors->first('active_flag', 'has-error')}}">
      {!! Form::label('active_flag', 'Status:') !!}
      {{ Form::select('active_flag', ['1'=>'Active','0'=>'In Active'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
      <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span>     
    </div>
  </div>
  

  <div class="col-md-12">
    <div class="form-group mt-20">

      <button type="submit" class="btn btn-sm btn-primary pull-right">Create</button>
      <a class="btn btn-sm btn-default pull-left" href="{{ route('clientadverts.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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

<script>
 var options = {
  filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Images',
  filebrowserImageUploadUrl: '{{public_path("article")}}/?type=Images&_token=',
  filebrowserBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Files',
  filebrowserUploadUrl: '{{public_path("article")}}/?type=Files&_token='
};
$('textarea.my-editor').ckeditor(options);
</script>
@endsection