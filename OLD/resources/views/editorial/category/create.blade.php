@extends('layouts/app')

@section('header')
<div class="page-header"> 
    <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Category/ Create </h3>
</div>
@endsection

@section('content')


<div class="row">
  <div class="col-md-offset-3 col-md-6">

      
         {!! Form::open(['route'=>'editorialcategory.store']) !!}

          @csrf   

        <div class="form-group row {{ $errors->first('name', 'has-error')}}">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                  {{ Form::input('text', 'name', null, ['class' => 'form-control','required'=>'required']) }}
               <span class="help-block">{{ $errors->first('name', ':message') }}</span> 
            </div>
        </div>
        <div class="form-group row  {{ $errors->first('title_tag', 'has-error')}}">
            <label for="title_tag" class="col-md-4 col-form-label text-md-right">{{ __('Anchor Title Tag') }}</label>

            <div class="col-md-6">
               {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}

               <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span> 
            </div>
        </div>

        <div class="form-group row  {{ $errors->first('url', 'has-error')}}">
            <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Category Url') }}</label>

            <div class="col-md-6">
              {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
               <span class="help-block">{{ $errors->first('url', ':message') }}</span> 
            </div>
        </div>


        <div class="form-group row  {{ $errors->first('description', 'has-error')}}">
            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-12">
             
                  {{ Form::textarea( 'description', null, ['class' => 'form-control','rows'=>'3']) }}
              <span class="help-block">{{ $errors->first('description', ':message') }}</span> 
            </div>
        </div>

        <div class="form-group row  {{ $errors->first('active_flag', 'has-error')}}">
            <label for="active_flag" class="col-md-4 col-form-label text-md-right">Status</label>

            <div class="col-md-6">
                  {{ Form::select('active_flag', ['1'=>'Active','0'=>'In Active'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
               <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span> 
           </div>
       </div>





       <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create') }}
            </button>
        </div>
        <div class="col-md-6 offset-md-4">
      <a class="btn btn-sm btn-default pull-right" href="{{ route('editorialcategory.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>
    </div>
</form>

</div>
</div>
@endsection

@section('scripts')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description');
</script>

@endsection

