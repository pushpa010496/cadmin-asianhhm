@extends('../layouts/app')

@section('header')

    <div class="page-header">

        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Articles / Create </h3>

    </div>

@endsection

@section('content')
    @include('error')

    <script>
    window.onload = function() {
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
    };
</script>
    <div class="row">

        <div class="col-md-offset-3 col-md-6">

                {!! Form::open(array('route' => 'article.store','files'=>true)) !!}                

             

                <div class="form-group">

                    {!! Form::label('title', 'Title:') !!}

                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}

                </div>

               

                <div class="form-group">

                    {!! Form::label('sub_title', 'Sub Title:') !!}

                    {{ Form::input('text', 'sub_title', null, ['class' => 'form-control']) }}

                </div>

                 <div class="form-group">

                    {!! Form::label('abstract', 'Abstract:') !!}

                    {{ Form::textarea('abstract', null, ['id' => 'editor1', 'class' => 'form-control my-editor','size'=>'30x4']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('short_description', 'Short Description:') !!}

                    {{ Form::textarea('short_description', null, ['class' => 'form-control','size'=>'30x4']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('home_short_description', 'Home Short Description:') !!}

                    {{ Form::textarea('home_short_description', null, ['class' => 'form-control','size'=>'30x4']) }}

                </div>
                <div class="form-group">

                    {!! Form::label('image', 'Image:') !!}

                    {{ Form::file('image', null, ['class' => 'form-control','size'=>'30x4']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('title_tag', 'Anchor Title Tag:') !!}

                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control']) }}

                </div>

               {{--  <div class="form-group">

                    {!! Form::label('author_name', 'Author Name:') !!}

                    {{ Form::input('text', 'author_name', null, ['class' => 'form-control','required'=>'required']) }}

                </div> --}}

                 <div class="form-group">

                    {!! Form::label('author_id', 'Author Name:') !!}

                    {{ Form::select('author_id[]', $author, null, ['class' => 'form-control','required'=>'required','multiple'=>'multiple']) }}

                </div>

               



                     {{--<div class="form-group">

                            {!! Form::label('description', 'Description:') !!}

                            {{ Form::textarea('description', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}

                        </div> --}}



             



                {{-- <div class="form-group">

                    {!! Form::label('alt_tag', 'Image Alt Tag:') !!}

                    {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}

                </div> --}}



                 {{-- <div class="form-group">

                    {!! Form::label('author_image', 'Author Image:') !!}

                    {{ Form::input('file', 'author_image', null, ['class' => 'form-control']) }}

                </div> --}}

               {{--  <div class="form-group">

                    {!! Form::label('author_details', 'Author Details:') !!}

                    {{ Form::textarea('author_details', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}

                </div> --}} 

              {{--   <div class="form-group">

                    {!! Form::label('authorbio', 'Author Bio:') !!}

                    {{ Form::textarea('authorbio', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}

                </div> --}}

                 <div class="form-group">

                    {!! Form::label('main_body', 'Main Body:') !!}

                    {{ Form::textarea('main_body', null, ['id' => 'editor2','class' => 'form-control my-editor','size'=>'30x4']) }}

                </div>



                <div class="form-group">

                    {!! Form::label('url', 'Article URL:') !!}

                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('home_articles', 'Home Status:') !!}

                    <select name="home_articles" class="form-control" required="required">

                        <option value="">-- Select one --</option>

                        <option value="1">Showing on Home Page</option>

                        <option value="0">Hide on Home Page</option>

                    </select>

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

                    <a class="btn btn-sm btn-default pull-right" href="{{ route('article.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

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