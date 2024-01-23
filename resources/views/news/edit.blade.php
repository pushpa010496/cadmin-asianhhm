@extends('../layouts/app')

@section('header')
    <div class="page-header">
        <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> News / Edit #{{$newsone->id}}</h3>
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

            <form action="{{ route('newsone.update', $newsone->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    {!! Form::label('date', 'Date:') !!}
                    {{ Form::input('text', 'date', old('date',$newsone->date), ['class' => 'form-control','required'=>'required','id'=>'datepicker']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', old('title',$newsone->title), ['class' => 'form-control','required'=>'required']) }}
                </div>
               
                 <div class="form-group">
                    {!! Form::label('image', 'News Image:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                     @if($newsone->image)
                       <img width="200" src="<?php echo config('app.url'); ?>news/<?php echo $newsone->image;?>">
                     @endif
                </div>
                <div class="form-group">
                    <input type="checkbox" name="display" value="1" {{ $newsone->display_img_home == 1 ? 'checked' : '' }}>
                    <label>Display on Home Page with Big Image</label>
                </div>

                <div class="form-group">
                    {!! Form::label('big_image', 'Big Image:') !!}
                     {!! Form::file('big_image', array('class' => '')) !!}
                     @if($newsone->big_image)
                       <img width="200" src="<?php echo config('app.url'); ?>news/<?php echo $newsone->big_image;?>">
                     @endif
                </div>
            
                <div class="form-group">
                    {!! Form::label('img_title', 'news Img Title:') !!}
                    {{ Form::input('text', 'img_title', old('img_title',$newsone->img_title), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('news_img_alt', 'news Img Alt:') !!}
                    {{ Form::input('text', 'news_img_alt', old('news_img_alt',$newsone->news_img_alt), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('location', 'Location:') !!}
                    {{ Form::input('text', 'location', old('location',$newsone->location), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('url', 'news Url:') !!}
                    {{ Form::input('text', 'url', old('url',$newsone->url), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {{ Form::textarea('description', old('description',$newsone->description), ['id' => 'editor1','class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('home_title', 'Home Title:') !!}
                    {{ Form::input('text', 'home_title', old('home_title',$newsone->home_title), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('home_description', 'Home Description:') !!}
                    {{ Form::textarea('home_description', old('home_description',$newsone->home_description), ['class' => 'form-control','size'=>'30x4']) }}
                </div>
                
                <div class="form-group">
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        @if($newsone->active_flag == 1)
                        <option value="1" selected="selected">Active</option>
                        <option value="0">InActive</option>
                        @elseif($newsone->active_flag == 0)
                        <option value="1">Active</option>
                        <option value="0" selected="selected">InActive</option>
                        @endif
                    </select>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('newsone.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
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
