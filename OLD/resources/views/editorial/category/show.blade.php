@extends('../layouts/app')
@section('header')
<div class="page-header">
  <h3>editorialcategory / Show #{{$editorialcategory->id}}</h3>
</div>
@endsection

@section('content')
<div class="well well-sm">
  <div class="row">
    <div class="col-md-6">
      <a class="btn btn-sm btn-default" href="{{ route('editorialcategory.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>

    <div class="col-md-6">
     <a class="btn btn-sm btn-warning pull-right" href="{{ route('editorialcategory.edit', $editorialcategory->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
   </div>
 </div>
</div>
<div class="well well-sm">
  <div class="row">
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Name :</h5>
      <h5>{{$editorialcategory->name }}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Anchor Title Tag :</h5>
      <h5>{{$editorialcategory->title_tag }}</h5>
    </div>
        <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Category Url :</h5>
      <h5>{{$editorialcategory->url }}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Description</h5>
      <h5>{!!$editorialcategory->description !!}</h5>
    </div>
   
   
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Status </h5>
      <h5>{{$editorialcategory->active_flag == 1 ? 'Active':'In Active' }}</h5>
    </div>

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
      <h5>{{ date('j F Y', strtotime($editorialcategory->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($editorialcategory->created_at)) }}</h5>
    </div>


    {{-- row end --}}
  </div>
  
</div>



@endsection
