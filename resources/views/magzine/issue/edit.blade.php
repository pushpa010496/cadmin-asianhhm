@extends('../layouts/app')

@section('header')
<div class="container">
    <div class="page-header">
        <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Issue / Edit #{{$issue->id}}</h3>
    </div>
  </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <div class="row  well well-sm">
            {!! Form::model($issue, ['url' => URL::to('issues/' . $issue->id), 'method' => 'put','files'=> true]) !!}
            @csrf   
            <div class="form-group">
                {!! Form::label('issue_no', 'Issue No:') !!}
                {{ Form::input('text','issue_no', null,['class' => 'form-control']) }}                    
           </div> 
           <div class="form-group">
                {!! Form::label('title', 'Issue Name:') !!}
                {{ Form::input('text','title', null,['class' => 'form-control']) }}                    
            </div>
            <div class="form-group">
                {!! Form::label('category', 'Category:') !!}
                {{  Form::select('category[]', $categories,$issue->categories,['class' => 'form-control','multiple'=>'true'])    }}                
            </div>
            <div class="form-group">
                {!! Form::label('active_flag', 'Status:') !!}
                {{  Form::select('active_flag', ['1' => 'Active', '0' => 'In Active'], null,['class' => 'form-control'])    }}                
            </div>  
            <div class="well well-sm">
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                <a class="btn btn-sm btn-default pull-right" href="{{ route('issues.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
            </div>
            {!! Form::close() !!}
          </div>
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
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>interview/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("interview")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>interview/?type=Files',
    filebrowserUploadUrl: '{{public_path("interview")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>

@endsection
    