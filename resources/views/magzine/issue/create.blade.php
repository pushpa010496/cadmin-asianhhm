@extends('layouts/app')

@section('header')

<div class="container">
  <div class="page-header"> 
    <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Magzine / Issue Create </h3>
  </div>
</div>
@endsection
@section('style')
<style type="text/css">

.has-error .help-block{
  color:#ff6666;
}
.has-error .form-control, .has-error .form-control:focus{
  border: 1px solid #ff6666;
}
</style>
@endsection

@section('content')


<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row  well well-sm">
      {!! Form::open(['route'=>'issues.store']) !!}

      @csrf   

      <div class="form-group {{ $errors->first('issue_no', 'has-error') }}">
       {!! Form::label('issue_no', 'Issue No:') !!}
       {{ Form::input('text','issue_no', null,['class' => 'form-control']) }}  
       <span class="help-block">{{ $errors->first('issue_no', ':message') }}</span>                  
     </div> 
     <div class="form-group {{ $errors->first('title', 'has-error') }}">
      {!! Form::label('title', 'Issue Name:') !!}
      {{ Form::input('text','title', null,['class' => 'form-control']) }}   
      <span class="help-block">{{ $errors->first('title', ':message') }}</span>                  
    </div>

    <div class="form-group {{ $errors->first('category', 'has-error') }}">
      {!! Form::label('category', 'Category:') !!}
      {{  Form::select('category[]', $categories,null,['class' => 'form-control','multiple'=>'true'])    }}
      <span class="help-block">{{ $errors->first('category', ':message') }}</span>                 
    </div>

    <div class="form-group {{ $errors->first('active_flag', 'has-error') }}">
      {!! Form::label('active_flag', 'Status:') !!}
      {{  Form::select('active_flag', ['1' => 'Active', '0' => 'In Active'], null,['class' => 'form-control'])    }}  
      <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span>               
    </div>  

    <div class="well well-sm ">
      <button type="submit" class="btn btn-sm btn-primary">Create</button>
      <a class="btn btn-sm btn-info pull-right" href="{{ route('issues.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    {!! Form::close() !!}
  </div>

</div>
</div>
@endsection

@section('scripts')


@endsection

