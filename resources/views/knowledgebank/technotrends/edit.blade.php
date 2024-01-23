@extends('../layouts/app')

@section('header')

    <div class="page-header">

        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Techno Trend / Edit #{{$technotrend->id}} </h3>

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

                {!!   Form::model($technotrend, ['route' => ['technotrends.update', $technotrend->id],'method' => 'put','files' => true]) !!}                

             



                 <div class="form-group">

                    {!! Form::label('title', 'Title:') !!}

                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}

                </div>



                <div class="form-group">

                    {!! Form::label('title_tag', 'Title Tag:') !!}

                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}

                </div>



                <div class="form-group">

                    {!! Form::label('url', 'Techno Trend URL:') !!}

                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('short_description', 'Short Description:') !!}

                    {{ Form::textarea('short_description', null, ['class' => 'form-control','size'=>'30x4']) }}

                </div>

                                       

                 <div class="form-group">

                    {!! Form::label('description', 'Content:') !!}

                    {{ Form::textarea('description', null, [ 'id' => 'editor1','class' => 'form-control my-editor','size'=>'30x4']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('home_technotrends', 'Show on Home page:') !!}

                    {{ Form::select('home_technotrends',['1'=>'Showing on Home Page','0'=>'Hide on Home Page'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('pdf', 'PDF:') !!}

                    {!! Form::file('pdf', ['class' => '']) !!}

                    @if($technotrend->pdf)

                    <a href="{{ config('app.url').'/knowledgebank/technotrends/'.$technotrend->pdf}}" target="_blank">View PDF</a>

                    

                    @endif

                </div>

               



                 <div class="form-group">

                    {!! Form::label('top_image', 'Top Image:') !!}

                    {!! Form::file('top_image', ['class' => '']) !!}

                    @if($technotrend->top_image)

                    <img width="200" src="{{ config('app.url').'/knowledgebank/technotrends/'.$technotrend->top_image}}">

                    @endif

                </div>



                  <div class="form-group">

                    {!! Form::label('alt_tag', 'Image Alt Tag:') !!}

                    {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control','required'=>'required']) }}

                </div>



                <div class="form-group">

                    {!! Form::label('active_flag', 'Status:') !!}

                   <select name="active_flag" class="form-control" required="required">

                        <option value="">-- Select one --</option>

                        @if($technotrend->active_flag == 1)

                        <option value="1" selected="selected">Active</option>

                        <option value="0">InActive</option>

                        @elseif($technotrend->active_flag == 0)

                        <option value="1">Active</option>

                        <option value="0" selected="selected">InActive</option>

                        @endif

                    </select>



                </div>                 

                <div class="well well-sm">

                    <button type="submit" class="btn btn-sm btn-primary">Create</button>

                    <a class="btn btn-sm btn-default pull-right" href="{{ route('technotrends.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

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