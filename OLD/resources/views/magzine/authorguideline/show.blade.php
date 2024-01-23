@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Author Guidelines / Show #{{$authorguideline->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('authorguideline.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('authorguideline.edit', $authorguideline->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
         
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Title</h5>
            <h5>{{$authorguideline->title }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>URL </h5>
            <h5>{{$authorguideline->url }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i> Image</h5>
            <img src="{{ config('app.url').'authorguidelines/pdf/'. $authorguideline->image}}" class="img-responsive">
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>PDF</h5>
            @if($authorguideline->pdf)
            <a href="{{ config('app.url').'authorguidelines/pdf/'.$authorguideline->pdf }}" target='_blank'>View file</a>
            @endif
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
            <h5>{{$authorguideline->title_tag }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
            <h5>{{$authorguideline->alt_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Description</h5>
            <h5>{!!$authorguideline->description !!}</h5>
          </div>

          

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Status </h5>
            <h5>{{$authorguideline->active_flag == 1 ? 'Active':'In Active' }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
              <h5>{{ date('j F Y', strtotime($authorguideline->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($authorguideline->created_at)) }}</h5>
          </div>


          {{-- row end --}}
        </div>
        
       </div>
        
     
  
@endsection
