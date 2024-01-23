@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Interviews / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                {!! Form::open(array('route' => 'interview.store','files'=>true)) !!}                
             
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {{ Form::input('text', 'name', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
               
                <div class="form-group">
                    {!! Form::label('designation', 'Designation:') !!}
                    {{ Form::input('text', 'designation', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {{ Form::textarea('description', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('home_interview', 'Show on Home page:') !!}
                    {{ Form::select('home_interview',['1'=>'Showing on Home Page','0'=>'Hide on Home Page'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('quest_answer', 'Add Question:') !!}
                    {{ Form::textarea('quest_answer', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
                
                <div class="form-group">
                    {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control']) }}
                </div>
               
                

                <div class="form-group">
                    {!! Form::label('alt_tag', 'Image Alt Tag:') !!}
                    {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}
                </div>

                 <div class="form-group">
                    {!! Form::label('photo', 'Image:') !!}
                    {{ Form::input('file', 'photo', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {!! Form::label('url', 'Interview URL:') !!}
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
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('interview.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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