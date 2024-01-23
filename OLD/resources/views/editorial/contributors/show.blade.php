@extends('../layouts/app')
@section('header')
<div class="page-header">
  <h3>Contributor / Show #{{$contributor->id}}</h3>
</div>
@endsection

@section('content')
<div class="well well-sm">
  <div class="row">
    <div class="col-md-6">
      <a class="btn btn-sm btn-default" href="{{ route('contributors.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>

    <div class="col-md-6">
     <a class="btn btn-sm btn-warning pull-right" href="{{ route('contributors.edit', $contributor->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
   </div>
 </div>
</div>
<div class="well well-sm">
  <div class="row">
   {{--  <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Category :</h5>
      <h5>{{@$contributor->category->name}}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Issue No :</h5>
      <h5>{{@$contributor->issue->issue_no }}</h5>
    </div>
        <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Issue No :</h5>
      <h5>{{@$contributor->editorialarticle->title }}</h5>
    </div> --}}
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Author Name</h5>
      <h5>{{$contributor->title }}</h5>
    </div>
  
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>URL </h5>
      <h5>{{$contributor->url }}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i> Image</h5>
      <img src="{{ config('app.url').'contributors/'. $contributor->image}}"  class="img-responsive" width="150" height="200">
    </div>
    

    
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Detais</h5>
      <h5>{{$contributor->details}}</h5>
    </div>

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Author Bio</h5>
      <h5>{!! $contributor->authorbio !!}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
      <h5>{{$contributor->title_tag }}</h5>
    </div>

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
      <h5>{{$contributor->alt_tag }}</h5>
    </div>
    

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Status </h5>
      <h5>{{$contributor->active_flag == 1 ? 'Active':'In Active' }}</h5>
    </div>

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
      <h5>{{ date('j F Y', strtotime($contributor->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($contributor->created_at)) }}</h5>
    </div>


    {{-- row end --}}
  </div>
  
</div>



@endsection
