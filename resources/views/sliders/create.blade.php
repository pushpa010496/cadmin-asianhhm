@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Sliders / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                 {!! Form::open(array('route' => 'sliders.store','files'=>true)) !!}
            
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                {!! Form::label('category', 'Category:') !!}
                   <select name="category" id="type" class="valid form-control" >
                        <option value="">select category</option>
                        <option value="Article">Article</option>
                        <option value="Interview">Interview</option>
                        <option value="Techno Trend">Techno Trend</option>
                        <option value="Project">Project</option>
                        <option value="Industry Report">Industry Report</option>
                        <option value="Research Insight">Research Insight</option>
                        <option value="Book Shelf">Book Shelf</option>
                        <option value="Case Study">Case Study</option> 
                        <option value="White Paper">White Paper</option>
                        <option value="News">News</option>
                        <option value="Press Release">Press Release</option>
                        <option value="Event">Event</option>
                        <option value="Webinar">Webinar</option>
                        <option value="Foreword">Foreword</option>
                        <option value="Author Guideline">Author Guideline</option>
                        <option value="Advisory Board">Advisory Board</option>
                        <option value="Editorial Calendar">Editorial Calendar</option>
                        <option value="Testimonial">Testimonial</option>
                    </select> 
                </div>
                <div class="form-group {{ $errors->first('issue_no', 'has-error')}}">
                    {!! Form::label('issue_no', 'Issue No:') !!}
                    {{ Form::select('issue_no', $issues, null, ['class' => 'form-control','required'=>'required']) }}
                    <span class="help-block">{{ $errors->first('issue_no', ':message') }}</span> 
                    </div>
                <div class="form-group">
                    {!! Form::label('from_date', 'From Date:') !!}
                    {{ Form::input('text', 'from_date', null, ['class' => 'form-control datepicker','required'=>'required','id'=>'datepicker']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('to_date', 'To Date:') !!}
                    {{ Form::input('text', 'to_date', null, ['class' => 'form-control datepicker','required'=>'required','id'=>'']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('url', 'slider Url:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('pages', 'Pages:') !!}
                    {{ Form::select('pages[]', $pages, null, ['class' => 'form-control','required'=>'required','multiple'=>'multiple','placeholder'=>'Select Page']) }}
                </div>
                <div class="form-group">
                   <select name="type" id="type" class="valid form-control">
                        <option value="">--None--</option>
                        <option value="image">Image</option>
                        <option value="swf">Flash</option>
                        <option value="script">Banner Script</option>
                    </select> 
                </div>
                <div class="typeclass" id="image">
                    <div class="form-group">
                    {!! Form::label('image', 'Sliders Image/Flash:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('img_title', 'Sliders Img Title:') !!}
                        {{ Form::input('text', 'img_title', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('img_alt', 'Sliders Img Alt:') !!}
                        {{ Form::input('text', 'img_alt', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="typeclass" id="script">
                    <div class="form-group">
                        {!! Form::label('script', 'Script:') !!}
                        {{ Form::textarea('script', null, ['class' => 'form-control','size'=>'30x4']) }}
                    </div>
                </div> 
                 <div class="form-group">
                 {!! Form::label( 'Other Emails for Enquiry: separete emails with comma (,)') !!}
                  {{ Form::input('text', 'emails', 'samsmith@ochre-media.com', ['class' => 'form-control','required'=>'required']) }}
              </div>
                <!-- <div class="form-group">
                    {!! Form::label('position', 'Position:') !!}
                    {{ Form::select('position', $position, null, ['class' => 'form-control','required'=>'required','placeholder'=>'Select Position']) }}
                </div>   -->       
                <div class="form-group">
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                 
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('sliders.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
    $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
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
 $(function() {       
    $('.typeclass').hide();
    $('#type').change(function(){
           var i= $('#type').val();
         if(i=="image") 
             {
                 $('#script').hide(); 
                 $('#image').show();
             }
           else if(i=="swf"){
               $('#image').show();
               $('#script').hide(); 
               }
            else if(i=="script"){
               $('#image').hide();
               $('#script').show(); 
            }
    });

});
</script>

@endsection