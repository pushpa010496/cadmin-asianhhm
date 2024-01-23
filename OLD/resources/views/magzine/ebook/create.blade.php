@extends('../layouts/app')
@section('header')
<div class="page-header">
  <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Ebook / Create </h3>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-offset-1 col-md-10 col-md-offset-1">
    <div class="row well well-sm">
     {!! Form::open(array('route' => 'ebooks.store','files'=>true)) !!}
     <div class="col-md-6">
       <div class="form-group {{ $errors->first('issue_id', 'has-error')}}">
        {!! Form::label('issue_id', 'issue no:') !!}
        {{ Form::select('issue_id', $issues, null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('issue_id', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">

      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'EBook Title:') !!}
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
      <div class="form-group {{ $errors->first('ebook_image', 'has-error')}}">
        {!! Form::label('ebook_image', 'Ebook Cover Image:') !!}
        {!! Form::file('ebook_image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('ebook_image', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group {{ $errors->first('magazine_image', 'has-error')}}">
        {!! Form::label('magazine_image', 'Magazine md Image:') !!}
        {!! Form::file('magazine_image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('magazine_image', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group {{ $errors->first('image_md', 'has-error')}}">
        {!! Form::label('image_md', 'Magazine Cover Image:') !!}
        {!! Form::file('image_md', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('image_md', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group {{ $errors->first('image_sm', 'has-error')}}">
        {!! Form::label('image_sm', 'Magazine sm Image:') !!}
        {!! Form::file('image_sm', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('image_sm', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">    
       <div class="form-group {{ $errors->first('script_type', 'has-error')}}">
        {!! Form::label('radio', 'Script Type:') !!}
     
        <label class="radio-inline">
          <input type="radio"  class="form-check-input" name="script_type" value="0">Script Code
        </label>
      
    
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="script_type" value="1">Script Tags
        </label>
      

        <span class="help-block">{{ $errors->first('script_type', ':message') }}</span>     
      </div>
      
      <div class="form-group {{ $errors->first('ebook_script', 'has-error')}}">
        {!! Form::label('ebook_script', 'Ebook Script:') !!}
        {{ Form::textarea( 'ebook_script', null, ['class' => 'form-control','rows'=>'5']) }}
        <span class="help-block">{{ $errors->first('ebook_script', ':message') }}</span>     
      </div>
    </div>
    <div class="col-md-6">

     <div class="form-group {{ $errors->first('ebook_script_home', 'has-error')}}">
      {!! Form::label('ebook_script_home', 'Home Ebook Script:') !!}
      {{ Form::textarea( 'ebook_script_home', null, ['class' => 'form-control','rows'=>'5']) }}
      <span class="help-block">{{ $errors->first('ebook_script_home', ':message') }}</span>     
    </div>
  </div>
  <div class="col-md-6">

    <div class="form-group  {{ $errors->first('topic_1', 'has-error')}}">
      {!! Form::label('topic_1', 'Topic 1:') !!}
      {{ Form::input('text', 'topic_1', null, ['class' => 'form-control','required'=>'required']) }}
      <span class="help-block">{{ $errors->first('topic_1', ':message') }}</span>  
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group  {{ $errors->first('topic_2', 'has-error')}}">
      {!! Form::label('topic_2', 'Topic 2:') !!}
      {{ Form::input('text', 'topic_2', null, ['class' => 'form-control']) }}
      <span class="help-block">{{ $errors->first('topic_2', ':message') }}</span>  
    </div>
  </div>
  <div class="col-md-6">

    <div class="form-group  {{ $errors->first('topic_3', 'has-error')}}">
      {!! Form::label('topic_3', 'Topic 3:') !!}
      {{ Form::input('text', 'topic_3', null, ['class' => 'form-control']) }}
      <span class="help-block">{{ $errors->first('topic_3', ':message') }}</span>  
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group  {{ $errors->first('topic_4', 'has-error')}}">
      {!! Form::label('topic_4', 'Topic 4:') !!}
      {{ Form::input('text', 'topic_4', null, ['class' => 'form-control']) }}
      <span class="help-block">{{ $errors->first('topic_4', ':message') }}</span>  
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group  {{ $errors->first('topic_5', 'has-error')}}">
      {!! Form::label('topic_5', 'Topic 5:') !!}
      {{ Form::input('text', 'topic_5', null, ['class' => 'form-control']) }}
      <span class="help-block">{{ $errors->first('topic_5', ':message') }}</span>  
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group  {{ $errors->first('topic_6', 'has-error')}}">
      {!! Form::label('topic_6', 'Topic 6:') !!}
      {{ Form::input('text', 'topic_6', null, ['class' => 'form-control']) }}
      <span class="help-block">{{ $errors->first('topic_6', ':message') }}</span>  
    </div>
  </div>
    <div class="col-md-6">
    <div class="form-group  {{ $errors->first('url', 'has-error')}}">
      {!! Form::label('url', 'Ebook URL:') !!}
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
      <a class="btn btn-sm btn-default pull-left" href="{{ route('ebooks.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
  $( function() {
    var dateFormat = "mm/dd/yy",
    from = $( "#from" )
    .datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1
    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
    }),
    to = $( "#to" ).datepicker({
      defaultDate: "+0w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1
    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }
  } );
</script>
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