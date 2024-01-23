@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Advertisers / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row" >
        <div class="col-md-offset-3 col-md-6">
                {!! Form::open(array('route' => 'advertisers.store','files'=>true)) !!}                
             <div id="advertise"> 
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title[]', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
               
                <div class="form-group">
                     {!! Form::label('category_id', 'Category:') !!}
                    {{ Form::select('category_id[]',$category, null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('title_tag', 'Title Tag:') !!}
                    {{ Form::input('text', 'title_tag[]', null, ['class' => 'form-control']) }}
                </div>
              

                <div class="form-group">
                    {!! Form::label('alt_tag', 'Alt Tag:') !!}
                    {{ Form::input('text', 'alt_tag[]', null, ['class' => 'form-control']) }}
                </div>

                 <div class="form-group">
                    {!! Form::label('image', 'Image:') !!}
                    {{ Form::input('file', 'image[]', null, ['class' => 'form-control']) }}
                </div>
            </div>
             <div id="advert"></div>
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
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('advertisers.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>

               
            </form>
            <button class="btn btn-success" id="adv">Add</button>
           
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
         var morecounter = 1;
        $('#adv').click(function(){
           morecounter++;
            $( '<div id="advertise"><div class="form-group">{!! Form::label("title", "Title:") !!}' + morecounter + '{{ Form::input("text", "title[]", null, ["class" => "form-control","required"=>"required"]) }}</div><div class="form-group">{!! Form::label("category_id", "Category:") !!}' + morecounter + '{{ Form::select("category_id[]",$category, null, ["class" => "form-control"]) }}</div><div class="form-group">{!! Form::label("title_tag", "Title Tag:") !!}' + morecounter + '{{ Form::input("text", "title_tag[]", null, ["class" => "form-control"]) }}</div><div class="form-group">{!! Form::label("alt_tag", "Alt Tag:") !!}' + morecounter + '{{ Form::input("text", "alt_tag[]", null, ["class" => "form-control"]) }}</div><div class="form-group">{!! Form::label("image", "Image:") !!}' + morecounter + '{{ Form::input("file", "image[]", null, ["class" => "form-control"]) }}</div>' ).appendTo( "#advert" );

        });
    });
</script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
   $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
  } );
  </script>
  <script>
     var options = {
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("article")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Files',
    filebrowserUploadUrl: '{{public_path("article")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>
@endsection