@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Industry / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                {!! Form::open(array('route' => 'industryreport.store')) !!}                
             
                <div class="form-group">
                    {!! Form::label('date', 'Date:') !!}
                    {{ Form::input('text', 'date', null, ['class' => 'form-control','required'=>'required','id'=>'datepicker']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('title1', 'Title1:') !!}
                    {{ Form::input('text', 'title1', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
               
                <div class="form-group">
                    {!! Form::label('title2', 'Title2:') !!}
                    {{ Form::input('text', 'title2', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('short_description', 'Short Description:') !!}
                    {{ Form::textarea('short_description', null, ['class' => 'form-control','size'=>'30x4']) }}
                </div>      
                 <div class="form-group">
                    {!! Form::label('author_details', 'Author Details:') !!}
                    {{ Form::textarea('author_details', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('full_report', 'Full Report:') !!}
                    {{ Form::textarea('full_report', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
                      
                <div class="form-group">
                    {!! Form::label('url', 'Report URL:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('active_flag', 'Status:') !!}
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>                 
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('industryreport.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
   $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
  } );
  </script>
  <script>
     var options = {
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>Interview/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("Interview")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>Interview/?type=Files',
    filebrowserUploadUrl: '{{public_path("Interview")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>
@endsection