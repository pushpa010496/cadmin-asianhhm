@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Book Shelf / Edit </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                {!! Form::model($bookshelf,array('route' => ['bookshelf.update',$bookshelf->id],'method'=>'PUT','files'=>true)) !!}                
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('sub_title', 'Sub Title:') !!}
                    {{ Form::input('text', 'sub_title', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('authors', 'Author Name:') !!}
                    {{ Form::input('text', 'authors', null, ['class' => 'form-control']) }}
                </div>

                   <div class="form-group">
                    {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
                    {{ Form::input('text', 'title_tag', null, ['class' => 'form-control']) }}
                </div> 
                 <div class="form-group">
                    {!! Form::label('publisher', 'Publisher:') !!}
                    {{ Form::input('text', 'publisher', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('publisher_date', 'From Date:') !!}
                    {{ Form::input('text', 'publisher_date', null, ['class' => 'form-control datepicker','required'=>'required','id'=>'datepicker']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('no_pages', 'No Of Pages:') !!}
                    {{ Form::input('text', 'no_pages', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('alt_tag', 'Anchor Alt Tag:') !!}
                    {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}
                </div>

               <div class="form-group">
                    {!! Form::label('bookshelf_image', 'BookShelf Image:') !!}
                    {{ Form::input('file', 'bookshelf_image', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                   <img src="{{config('app.url').'/knowledgebank/bookshelf/'.$bookshelf->bookshelf_image}}" height="100px" width="100px">
                </div> 
                 <div class="form-group">
                    {!! Form::label('description', 'BookShelf Description:') !!}
                    {{ Form::textarea('description', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>

               
                  <div class="form-group">
                    {!! Form::label('url', 'BookShelf URL:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}
                </div>
               <div class="form-group">
                    {!! Form::label('active_flag', 'Status:') !!}
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        @if($bookshelf->active_flag == 1)
                        <option value="1" selected="selected">Active</option>
                        <option value="0">InActive</option>
                        @elseif($bookshelf->active_flag == 0)
                        <option value="1">Active</option>
                        <option value="0" selected="selected">InActive</option>
                        @endif
                    </select>
                </div>                 
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('bookshelf.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>bookshelf/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("bookshelf")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>bookshelf/?type=Files',
    filebrowserUploadUrl: '{{public_path("bookshelf")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>
@endsection