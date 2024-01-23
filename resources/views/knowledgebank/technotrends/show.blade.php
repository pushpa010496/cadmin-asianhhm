@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Techno Trend / Show #{{$technotrend->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('technotrends.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                  <a class="btn btn-sm btn-warning pull-right" href="{{ route('technotrends.edit', $technotrend->id) }}"> <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $technotrend->title }}</h5>
              </div>
             </div>

             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $technotrend->title_tag }}</h5>
              </div>
             </div>

              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Techno Trend URL</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $technotrend->url }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Short Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $technotrend->short_description !!}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>content</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $technotrend->description !!}</h5>
              </div>
             </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Home Technotrends</h5>
              </div>
              <div class="col-md-9">
                <h5>>@if($technotrend->home_technotrends == 1)
                    Showing on Home Page
                    @elseif($technotrend->home_technotrends == 0)
                    Hide on Home Page
                    @endif</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Top Image</h5>
              </div>
              <div class="col-md-9">              
                  @if($technotrend->top_image)
                  <img width="200" src="{{ config('app.url').'/knowledgebank/technotrends/'.$technotrend->top_image}}">
                  @endif

              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image Alt Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $technotrend->alt_tag }}</h5>
              </div>
             </div>

               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>PDF</h5>
              </div>
              <div class="col-md-9">              
                  @if($technotrend->pdf)
                  <a href="{{ config('app.url').'/knowledgebank/technotrends/'.$technotrend->pdf}}" target="_blank">View PDF</a>
                  
                  @endif

              </div>
             </div>
           

            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($technotrend->active_flag == 1)
                    Active
                    @elseif($technotrend->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
