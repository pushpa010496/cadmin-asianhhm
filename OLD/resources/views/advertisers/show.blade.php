@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Advertiser / Show #{{$advertiser->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('advertisers.edit', $advertiser->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $advertiser->title }}</h5>
              </div>
             </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Category</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $advertiser->category->name }}</h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($advertiser->image)
                  <img width="200" src="<?php echo config('app.url'); ?>/advertisers/<?php echo $advertiser->image;?>">
                  @endif
                </h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($advertiser->active_flag == 1)
                    Active
                    @elseif($advertiser->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
