@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Projects / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                {!! Form::open(array('route' => 'project.store','files'=>true)) !!}                
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control']) }}
                </div>

                   <div class="form-group">
                    {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control']) }}
                </div> 
                <div class="form-group">
                    {!! Form::label('alt_tag', 'Anchor Alt Tag:') !!}
                    {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}
                </div>

               <div class="form-group">
                    {!! Form::label('short_description', 'Short Description:') !!}
                    {{ Form::textarea('short_description', null, ['class' => 'form-control','size'=>'30x4']) }}
                </div>
             
                 <div class="form-group">
                    {!! Form::label('description', 'Project Description:') !!}
                    {{ Form::textarea('description', null, ['class' => 'form-control my-editor','size'=>'30x4','required'=>'required']) }}
                </div>

                 <div class="form-group">
                    {!! Form::label('image', 'Project Image:') !!}
                    {{ Form::input('file', 'image', null, ['class' => 'form-control']) }}
                </div>
                  <div class="form-group">
                    {!! Form::label('project_name', 'Project Name:') !!}
                    {{ Form::input('text', 'project_name', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('location', 'Location:') !!}
                    {{ Form::input('text', 'location', null, ['class' => 'form-control']) }}
                   
                </div>
                

                <div class="form-group">
                    {!! Form::label('commence', 'Commencement:') !!}
                    {{ Form::input('text', 'commence', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {!! Form::label('completion', 'Completion:') !!}
                    {{ Form::input('text', 'completion', null, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('est_inv', 'Estimated Investement:') !!}
                    {{ Form::input('text', 'est_inv', null, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('capacity', 'Capacity:') !!}
                    {{ Form::input('text', 'capacity', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('key_player', 'Key Players:') !!}
                    {{ Form::input('text', 'key_player', null, ['class' => 'form-control']) }}
                </div> 
                  <div class="form-group">
                    {!! Form::label('url', 'Project URL:') !!}
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
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('project.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>project/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("project")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>project/?type=Files',
    filebrowserUploadUrl: '{{public_path("project")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>
@endsection