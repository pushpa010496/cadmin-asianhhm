@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Client Adverts / Show #{{$clientadvert->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('clientadverts.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('clientadverts.edit', $clientadvert->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
          <div class="col-md-6">
             <h5 class="text-primary"><i class="role icon"></i>Issue No</h5>
              <h5>{{ $clientadvert->issue->issue_no }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Title</h5>
            <h5>{{$clientadvert->title }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Client Advert Image</h5>
            <img src="{{ config('app.url').'clientadverts/'. str_slug($clientadvert->issue->issue_no).'/'. $clientadvert->client_advert_image}}" class="img-responsive">
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Client Advert Cover Image</h5>
            <img src="{{ config('app.url').'clientadverts/'.str_slug($clientadvert->issue->issue_no).'/'.$clientadvert->client_advert_cover_image }}" class="img-responsive">
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
            <h5>{{$clientadvert->title_tag }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
            <h5>{{$clientadvert->alt_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Description</h5>
            <h5>{{$clientadvert->description }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>URL </h5>
            <h5>{{$clientadvert->url }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Status </h5>
            <h5>{{$clientadvert->active_flag == 1 ? 'Active':'In Active' }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
              <h5>{{ date('j F Y', strtotime($clientadvert->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($clientadvert->created_at)) }}</h5>
          </div>


          {{-- row end --}}
        </div>
        
       </div>
        
     
  
@endsection
