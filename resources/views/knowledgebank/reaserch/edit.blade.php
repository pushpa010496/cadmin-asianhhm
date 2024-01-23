@extends('../layouts/app')

@section('header')

    <div class="page-header">

        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Research Insites / Edit #{{$reaserchinsite->id}} </h3>

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

                {!!   Form::model($reaserchinsite, ['route' => ['reaserchinsites.update', $reaserchinsite->id],'method' => 'put','enctype' => 'multipart/form-data']) !!}                

             



              <div class="form-group">

                    {!! Form::label('title', 'Title:') !!}

                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}

                </div>

               

                <div class="form-group">

                    {!! Form::label('sub_title', 'Sub Title:') !!}

                    {{ Form::input('text', 'sub_title', null, ['class' => 'form-control']) }}

                </div>

                <div class="form-group">
                {!! Form::label('image', 'Image:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                     @if($reaserchinsite->image)
                       <img width="200" src="<?php echo config('app.url'); ?>knowledgebank/research-insights/<?php echo $reaserchinsite->image;?>">
                     @endif
                </div>
                  <div class="form-group">

                    {!! Form::label('title_tag', 'Title Tag:') !!}

                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}

                </div>

                

                 <div class="form-group">

                    {!! Form::label('published_date', 'Published Date:') !!}

                    {{ Form::input('text', 'published_date', null, ['class' => 'form-control','required'=>'required','id'=>'datepicker']) }}

                </div>

         

                 <div class="form-group">

                    {!! Form::label('short_description', 'Short Description:') !!}

                    {{ Form::textarea('short_description', null, ['class' => 'form-control','size'=>'30x4']) }}

                </div>

                 <div class="form-group">

                    {!! Form::label('author_details', 'Author Details:') !!}

                    {{ Form::textarea('author_details', null, [ 'id' => 'editor1','class' => 'form-control my-editor','size'=>'30x4']) }}

                </div>

                 <div class="form-group">

                    {!! Form::label('description', 'Description:') !!}

                    {{ Form::textarea('description', null, [ 'id' => 'editor2','class' => 'form-control my-editor','size'=>'30x4']) }}

                </div>

                  <div class="form-group">

                    {!! Form::label('on_home', 'Show on Home page:') !!}

                    {{ Form::select('on_home',['1'=>'Showing on Home Page','0'=>'Hide on Home Page'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}

                </div>     

                <div class="form-group">

                    {!! Form::label('url', ' URL:') !!}

                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('active_flag', 'Status:') !!}

                   <select name="active_flag" class="form-control" required="required">

                        <option value="">-- Select one --</option>

                        @if($reaserchinsite->active_flag == 1)

                        <option value="1" selected="selected">Active</option>

                        <option value="0">InActive</option>

                        @elseif($reaserchinsite->active_flag == 0)

                        <option value="1">Active</option>

                        <option value="0" selected="selected">InActive</option>

                        @endif

                    </select>



                </div>                 

                <div class="well well-sm">

                    <button type="submit" class="btn btn-sm btn-primary">Update</button>

                    <a class="btn btn-sm btn-default pull-right" href="{{ route('reaserchinsites.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

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



@endsection