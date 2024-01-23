@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Testimonials / Show #{{$testimonial->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('testimonials.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('testimonials.edit', $testimonial->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
         
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Client Name</h5>
            <h5>{{$testimonial->name }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Anchor Title Tag </h5>
            <h5>{{$testimonial->title_tag }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Image </h5>
            <h5>
                  @if($testimonial->image)
                  <img width="200" src="<?php echo config('app.url'); ?>/testimonials/<?php echo $testimonial->image;?>">
                  @endif
                </h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Client Company </h5>
            <h5>{{$testimonial->company }}</h5>
          </div>
         
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Designation </h5>
            <h5>{{$testimonial->designation }}</h5>
          </div>


          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Description</h5>
            <h5>{!!$testimonial->description !!}</h5>
          </div>

          
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Testimonial URL </h5>
            <h5>{{$testimonial->url }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Status </h5>
            <h5>{{$testimonial->active_flag == 1 ? 'Active':'In Active' }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
              <h5>{{ date('j F Y', strtotime($testimonial->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($testimonial->created_at)) }}</h5>
          </div>


          {{-- row end --}}
        </div>
        
       </div>
        
     
  
@endsection
