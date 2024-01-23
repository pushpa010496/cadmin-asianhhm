@extends('../layouts/app')

@section('header')
<div class="container">
<div class="page-header">
  <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Callender / Edit #{{$callender->id}}</h3>
</div>
 </div>
@endsection

@section('content')


<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row well well-sm">
      {!! Form::model($callender, ['url' => URL::to('callender/' . $callender->id), 'method' => 'put','files'=> true]) !!}
     @csrf 


    <div class="">
      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'Title:') !!}
        {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title', ':message') }}</span>     
      </div>
    </div>
    
    <div class="">
      <div class="form-group {{ $errors->first('sub_title', 'has-error')}}">
        {!! Form::label('sub_title', 'Sub Title:') !!}
        {{ Form::input('text', 'sub_title', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('sub_title', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group  {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('url', 'Client Adverts URL:') !!}
        {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('url', ':message') }}</span>  
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
        {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>     
      </div>    
    </div>
    <div class="">
      <div class="form-group {{ $errors->first('image', 'has-error')}}">
        {!! Form::label('image', 'Image :') !!}
        {!! Form::file('image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('image', ':message') }}</span>     
      </div>
       @if($callender->image)
        <a href="{{ config('app.url').'callender/'.$callender->image}}" target="_blank">view image</a>
      @endif
    </div>  
    <div class="">

      <div class="form-group {{ $errors->first('pdf', 'has-error')}}">
        {!! Form::label('pdf', 'PDF:') !!}
        {!! Form::file('pdf', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('pdf', ':message') }}</span>     
      </div>
       @if($callender->pdf)
        <a href="{{ config('app.url').'callender/'. $callender->pdf}}" target="_blank">view image</a>
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
    <div class="form-group  {{ $errors->first('active_flag', 'has-error')}}">
      {!! Form::label('active_flag', 'Status:') !!}
      {{ Form::select('active_flag', ['1'=>'Active','0'=>'In Active'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
      <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span>     
    </div>
  </div>
  

  <div class="col-md-12">
    <div class="form-group mt-20">
      <button type="submit" class="btn btn-sm btn-primary">Save</button>
      <a class="btn btn-sm btn-default pull-right" href="{{ route('callender.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
    </div>
  </div>

  {!! Form::close() !!}
</div>
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
  filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>interview/?type=Images',
  filebrowserImageUploadUrl: '{{public_path("interview")}}/?type=Images&_token=',
  filebrowserBrowseUrl: '<?php echo config("app.url"); ?>interview/?type=Files',
  filebrowserUploadUrl: '{{public_path("interview")}}/?type=Files&_token='
};
$('textarea.my-editor').ckeditor(options);
</script>
@endsection