@extends('../layouts/app')

@section('header')
<div class="page-header">
  <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Editorial Article / Edit #{{$editorialarticle->id}}</h3>
</div>
@endsection

@section('content')


<div class="row">
  <div class="col-md-offset-3 col-md-6 ">
    <div class="row well well-sm">
      {!! Form::model($editorialarticle, ['url' => URL::to('editorialarticle/' . $editorialarticle->id), 'method' => 'put','files'=> true]) !!}
      @csrf 
      <div class="">
        <div class="form-group {{ $errors->first('category_id', 'has-error')}}">
          {!! Form::label('category_id', 'Category:') !!}
          {{ Form::select('category_id', $categories, $editorialarticle->category_id, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('category_id', ':message') }}</span> 
        </div>
      </div>
      <div class="">
        <div class="form-group  {{ $errors->first('issue_id', 'has-error')}}">
          {!! Form::label('issue_id', 'Issue No:') !!}
          {{ Form::select('issue_id', $issues, $editorialarticle->issue_id, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('issue_id', ':message') }}</span> 
        </div>
      </div>
       <div class="">
        <div class="form-group  {{ $errors->first('author_id', 'has-error')}}">
          {!! Form::label('author_id', 'Author Name:') !!}
          {{ Form::select('author_id[]', $author, $editorialarticle->authors()->pluck('id'), ['class' => 'form-control','required'=>'required','multiple'=>'multiple','size'=>'20']) }}
          <span class="help-block">{{ $errors->first('author_id', ':message') }}</span> 
        </div>
      </div>




      <div class="">
        <div class="form-group {{ $errors->first('title', 'has-error')}}">
          {!! Form::label('title', 'Title:') !!}
          {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('title', ':message') }}</span>     
        </div>
      </div>

      <div class="">
        <div class="form-group {{ $errors->first('sub_title', 'has-error')}}">
          {!! Form::label('sub_title', 'Sub Title:') !!}
          {{ Form::input('text', 'sub_title', null, ['class' => 'form-control']) }}
          <span class="help-block">{{ $errors->first('sub_title', ':message') }}</span>     
        </div>
      </div>
      <div class="">

        <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
          {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
          {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span>     
        </div>
      </div>
      <div class="">    
        <div class="form-group {{ $errors->first('abstract', 'has-error')}}">
          {!! Form::label('abstract', 'Abstract:') !!}
          {{ Form::textarea( 'abstract', null, ['class' => 'form-control','rows'=>'5']) }}
          <span class="help-block">{{ $errors->first('abstract', ':message') }}</span>     
        </div>
      </div>
       <div class="">    
        <div class="form-group {{ $errors->first('short_description', 'has-error')}}">
          {!! Form::label('short_description', 'Short Description:') !!}
          {{ Form::textarea( 'short_description', null, ['class' => 'form-control','rows'=>'5']) }}
          <span class="help-block">{{ $errors->first('short_description', ':message') }}</span>     
        </div>
      </div>
      <div class="">    
        <div class="form-group {{ $errors->first('description', 'has-error')}}">
          {!! Form::label('description', 'Description:') !!}
          {{ Form::textarea( 'description', null, ['class' => 'form-control','rows'=>'5']) }}
          <span class="help-block">{{ $errors->first('description', ':message') }}</span>     
        </div>
      </div>
         <div class="">
      <div class="form-group  {{ $errors->first('on_home', 'has-error')}}">
        {!! Form::label('on_home', 'Show on Home page:') !!}
        {{ Form::select('on_home', ['1'=>'Show','0'=>'Hide'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
        <span class="help-block">{{ $errors->first('on_home', ':message') }}</span>     
      </div>
    </div> 
      <div class="">
        <div class="form-group {{ $errors->first('image', 'has-error')}}">
          {!! Form::label('image', 'Image :') !!}
          {!! Form::file('image', array('class' => '')) !!}
          <span class="help-block">{{ $errors->first('image', ':message') }}</span>     
        </div>
        @if($editorialarticle->image)
        <a href="{{ config('app.url').'editorialarticle/'.$editorialarticle->image}}" target="_blank">view image</a>
        @endif
      </div>  

      <div class="">
        <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
          {!! Form::label('alt_tag', 'Image Alt Tag:') !!}
          {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control']) }}
          <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>     
        </div>    
      </div>
      <div class="">
        <div class="form-group  {{ $errors->first('url', 'has-error')}}">
          {!! Form::label('url', 'Online Article Url:') !!}
          {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
          <span class="help-block">{{ $errors->first('url', ':message') }}</span>  
        </div>
      </div>


      <div class="">
        <div class="form-group  {{ $errors->first('active_flag', 'has-error')}}">
          {!! Form::label('active_flag', 'Status:') !!}
          {{ Form::select('active_flag', ['1'=>'Active','0'=>'In Active'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
          <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span>     
        </div>
      </div>


      <div class="col-md-12">
        <div class="form-group mt-20">
          <button type="submit" class="btn btn-sm btn-primary">Save</button>
          <a class="btn btn-sm btn-default pull-right" href="{{ route('editorialarticle.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
        </div>
      </div>

      {!! Form::close() !!}
    </div>
  </div>

</div>
</div>
@endsection
@section('scripts')
{{-- <script type="text/javascript" src="http://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script> --}}
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    // CKEDITOR.replace('description');
</script>
<script type="text/javascript">
   CKEDITOR.replace('description');
  // CKEDITOR.replace('description', {
  //     extraPlugins: 'image2',

  //     toolbar: [{
  //         name: 'clipboard',
  //         items: ['Undo', 'Redo','alignment']
  //       },

  //       {
  //         name: 'styles',
  //         items: ['Styles', 'Format']
  //       },
  //       {
  //         name: 'basicstyles',
  //         items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
  //       },
  //       {
  //         name: 'paragraph',
  //         items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
  //       },
  //       {
  //         name: 'links',
  //         items: ['Link', 'Unlink']
  //       },
  //       {
  //         name: 'insert',
  //         items: ['Image', 'Table']
  //       },
  //       {
  //         name: 'tools',
  //         items: ['Maximize']
  //       },
  //       {
  //         name: 'editing',
  //         items: ['Scayt']
  //       },
         
  //     ],


    
  //   });
</script>
@endsection