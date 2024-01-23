@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Advisor Board / Show #{{$advisorboard->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('advisorboard.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('advisorboard.edit', $advisorboard->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
         
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Title</h5>
            <h5>{{$advisorboard->title }}</h5>
          </div>
          
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
            <h5>{{$advisorboard->title_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i> Image</h5>
            <img src="{{ config('app.url').'advisoryboard/'. $advisorboard->image}}" class="img-responsive">
          </div>
         
          
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
            <h5>{{$advisorboard->alt_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Description</h5>
            <h5>{!! $advisorboard->description !!}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Home Description</h5>
            <h5>{{$advisorboard->home_description }}</h5>
          </div>

           

            <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Show on Home Page </h5>
            <h5>{{$advisorboard->home_flag == 1 ? 'Show':'Hide' }}</h5>
          </div>
          

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Status </h5>
            <h5>{{$advisorboard->active_flag == 1 ? 'Active':'In Active' }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
              <h5>{{ date('j F Y', strtotime($advisorboard->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($advisorboard->created_at)) }}</h5>
          </div>


          {{-- row end --}}
        </div>
        
       </div>
        
     
  
@endsection
