@extends('../layouts/app')
@section('header')
<div class="page-header">
  <h3>Editorial Article / Show #{{$editorialarticle->id}}</h3>
</div>
@endsection

@section('content')
<div class="well well-sm">
  <div class="row">
    <div class="col-md-6">
      <a class="btn btn-sm btn-default" href="{{ route('editorialarticle.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>

    <div class="col-md-6">
     <a class="btn btn-sm btn-warning pull-right" href="{{ route('editorialarticle.edit', $editorialarticle->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
   </div>
 </div>
</div>
<div class="well well-sm">
  <div class="row">
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Category :</h5>
      <h5>{{$editorialarticle->category->name }}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Issue No :</h5>
      <h5>{{$editorialarticle->issue->issue_no }}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Author Name</h5>
      <h5>
        @foreach($editorialarticle->authors()->get() as $author)
       <h5> {{$author->title }}</h5>
       @endforeach
     </h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Title</h5>
      <h5>{{$editorialarticle->title }}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Sub Title</h5>
      <h5>{{$editorialarticle->sub_title }}</h5>
    </div>
       
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>URL </h5>
      <h5>{{$editorialarticle->url }}</h5>
    </div>
    @if($editorialarticle->image)
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i> Image</h5>
      <img src="{{ config('app.url').'editorialarticle/'. $editorialarticle->image}}"  class="img-responsive" width="150" height="200">
    </div>
    @endif

    
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Abstract</h5>
      <h5>{!! $editorialarticle->abstract !!}</h5>
    </div>
   
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Description</h5>
      <h5>{!!$editorialarticle->description !!}</h5>
    </div>
     <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Short Description</h5>
      <h5>{!! $editorialarticle->short_description !!}</h5>
    </div>
    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
      <h5>{{$editorialarticle->title_tag }}</h5>
    </div>

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
      <h5>{{$editorialarticle->alt_tag }}</h5>
    </div>
    

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Status </h5>
      <h5>{{$editorialarticle->active_flag == 1 ? 'Active':'In Active' }}</h5>
    </div>

    <div class="col-md-6">
      <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
      <h5>{{ date('j F Y', strtotime($editorialarticle->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($editorialarticle->created_at)) }}</h5>
    </div>


    {{-- row end --}}
  </div>
  
</div>



@endsection
