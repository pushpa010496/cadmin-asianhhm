@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Tech Spec / Show #{{$techspec->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('techspec.edit', $techspec->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $techspec->title }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Sub Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $techspec->sub_title }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $techspec->title_tag }}</h5>
              </div>
             </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Tech Spec URL</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $techspec->target_url }}</h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($techspec->image)
                  <img width="200" src="<?php echo config('app.url'); ?>/techspec/<?php echo $techspec->image;?>">
                  @endif
                </h5>
              </div>
             </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>PDF</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($techspec->pdf)
                  <a href="<?php echo config('app.url'); ?>techspec/<?php echo $techspec->pdf;?>" target="_blank">View File</a>
                  @endif
                </h5>
              </div>
             </div>
          
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $techspec->description !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($techspec->active_flag == 1)
                    Active
                    @elseif($techspec->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
