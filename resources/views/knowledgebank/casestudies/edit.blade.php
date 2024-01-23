@extends('../layouts/app')

@section('header')

    <div class="page-header">

        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Case Study / Edit </h3>

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

                {!! Form::model($casestudy,array('route' => ['casestudies.update',$casestudy->id],'method'=>'PUT','files'=>true,'enctype' => 'multipart/form-data')) !!}                

                <div class="form-group">

                    {!! Form::label('title', 'Title:') !!}

                    {{ Form::input('text', 'title', null, ['class' => 'form-control']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('sub_title', 'Sub Title:') !!}

                    {{ Form::input('text', 'sub_title', null, ['class' => 'form-control']) }}

                </div>



                   <div class="form-group">

                    {!! Form::label('title_tag', 'Anchor Title Tag:') !!}

                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control']) }}

                </div> 


                <div class="form-group">
                {!! Form::label('image', 'Image:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                     @if($casestudy->image)
                       <img width="200" src="<?php echo config('app.url'); ?>knowledgebank/casestudies/<?php echo $casestudy->image;?>">
                     @endif
                </div>

                <div class="form-group">

                    {!! Form::label('short_description', 'Short Description:') !!}

                    {{ Form::textarea('short_description', null, ['class' => 'form-control','size'=>'30x4']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('pdf', 'Case Study Pdf:') !!}

                    {{ Form::input('file', 'pdf', null, ['class' => 'form-control','enctype' => 'multipart/form-data']) }}

                </div>

                @if($casestudy->pdf)

                    <a href="{{ config('app.url').'/knowledgebank/casestudies/'.$casestudy->pdf}}" target="_blank">view Pdf</a>

                  @endif

               

                 <div class="form-group">

                    {!! Form::label('description', 'casestudies Description:') !!}

                    {{ Form::textarea('description', null, ['id' => 'editor1','class' => 'form-control my-editor','size'=>'30x4']) }}

                </div>

                 <div class="form-group">

                    {!! Form::label('home_casestudies', 'Show on Home page:') !!}

                    {{ Form::select('home_casestudies',['1'=>'Showing on Home Page','0'=>'Hide on Home Page'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}

                </div>



                  <div class="form-group">

                    {!! Form::label('url', 'Case Study URL:') !!}

                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}

                </div>

                <div class="form-group">

                    {!! Form::label('active_flag', 'Status:') !!}

                    <select name="active_flag" class="form-control" required="required">

                        <option value="">-- Select one --</option>

                        @if($casestudy->active_flag == 1)

                        <option value="1" selected="selected">Active</option>

                        <option value="0">InActive</option>

                        @elseif($casestudy->active_flag == 0)

                        <option value="1">Active</option>

                        <option value="0" selected="selected">InActive</option>

                        @endif

                    </select>

                </div>                

                <div class="well well-sm">

                    <button type="submit" class="btn btn-sm btn-primary">Update</button>

                    <a class="btn btn-sm btn-default pull-right" href="{{ route('casestudies.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

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

    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>casestudies/?type=Images',

    filebrowserImageUploadUrl: '{{public_path("casestudies")}}/?type=Images&_token=',

    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>casestudies/?type=Files',

    filebrowserUploadUrl: '{{public_path("casestudies")}}/?type=Files&_token='

  };

 $('textarea.my-editor').ckeditor(options);

</script>

@endsection