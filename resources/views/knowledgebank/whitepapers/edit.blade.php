@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> White Papers / Edit </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                {!! Form::model($whitepaper,array('route' => ['whitepaper.update',$whitepaper->id],'method'=>'PUT','files'=>true)) !!}                
                <div class="form-group {{ $errors->first('title', 'has-error')}}">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control']) }}
                      <span class="help-block">{{ $errors->first('title', ':message') }}</span>   
                </div>
                   <div class="form-group {{ $errors->first('type', 'has-error')}}">
                    {!! Form::label('type', 'Type:') !!}
                    {{ Form::select('type', array('1' => 'image', '2' => 'pdf','3' => 'both'),$whitepaper->type,['class' => 'form-control','id'=>'type_p']) }}
                </div>

                <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
                    {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control']) }}
                    <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span> 
                </div> 
                <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
                    {!! Form::label('alt_tag', 'Image Alt Tag:') !!}
                    {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}
                    <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span> 
                </div> 

                 <div class="form-group">
                    {!! Form::label('short_description', 'Short Description:') !!}
                    {{ Form::textarea('short_description', null, ['class' => 'form-control','size'=>'30x4']) }}
                </div>
                  <div class="form-group {{ $errors->first('image', 'has-error')}}">
                    {!! Form::label('image', 'Image :') !!}
                    {!! Form::file('image', array('class' => '')) !!}
                    <span class="help-block">{{ $errors->first('image', ':message') }}</span>     
                  </div>
                   @if($whitepaper->image)
                    <a href="{{ config('app.url').'knowledgebank/whitepaper/'.$whitepaper->image}}" target="_blank">view image</a>
                  @endif
               

                  <div class="form-group {{ $errors->first('pdf', 'has-error')}}">
                    {!! Form::label('pdf', 'PDF:') !!}
                    {!! Form::file('pdf', array('class' => '')) !!}
                    <span class="help-block">{{ $errors->first('pdf', ':message') }}</span>     
                  </div>
                   @if($whitepaper->pdf)
                    <a href="{{ config('app.url').'knowledgebank/whitepaper/'. $whitepaper->pdf}}" target="_blank">view Pdf</a>
                  @endif
               
                 <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {{ Form::textarea('description', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('home_whitepapers', 'Show on Home page:') !!}
                    {{ Form::select('home_whitepapers',['1'=>'Showing on Home Page','0'=>'Hide on Home Page'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
                </div>
                  <div class="form-group">
                    {!! Form::label('url', 'URL:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('active_flag', 'Status:') !!}
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        @if($whitepaper->active_flag == 1)
                        <option value="1" selected="selected">Active</option>
                        <option value="0">InActive</option>
                        @elseif($whitepaper->active_flag == 0)
                        <option value="1">Active</option>
                        <option value="0" selected="selected">InActive</option>
                        @endif
                    </select>
                </div>                
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('whitepaper.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>whitepaper/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("casestudies")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>whitepaper/?type=Files',
    filebrowserUploadUrl: '{{public_path("casestudies")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>
@endsection