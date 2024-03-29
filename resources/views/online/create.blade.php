@extends('../layouts/app')

@section('header')

    <div class="page-header">

        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Online / Create </h3>

    </div>

@endsection



@section('content')

    @include('error')


    <script>
    window.onload = function() {
        CKEDITOR.replace( 'editor1' );
        
    };
</script>
    <div class="row">

        <div class="col-md-offset-3 col-md-6">

                {!! Form::open(array('route' => 'online.store','files'=>true)) !!}                

             

                <div class="form-group">

                    {!! Form::label('title', 'Title:') !!}

                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}

                </div>

               

                <div class="form-group">

                    {!! Form::label('sub_title', 'Sub Title:') !!}

                    {{ Form::input('text', 'sub_title', null, ['class' => 'form-control']) }}

                </div>



                <div class="form-group">

                    {!! Form::label('title_tag', 'Title Tag:') !!}

                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control']) }}

                </div>



                <div class="form-group">

                    {!! Form::label('alt_tag', 'Alt Tag:') !!}

                    {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}

                </div>

                 <div class="form-group">

                    {!! Form::label('image', 'Image:') !!}

                    {{ Form::input('file', 'image', null, ['class' => 'form-control']) }}

                </div>





                <div class="form-group">

                    {!! Form::label('description', 'Description:') !!}

                    {{ Form::textarea('description', null, ['id' => 'editor1','class' => 'form-control my-editor','size'=>'30x4']) }}

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

                    <a class="btn btn-sm btn-default pull-right" href="{{ route('online.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

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



@endsection