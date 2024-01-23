@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>White Papers / Show #{{$whitepaper->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('whitepaper.edit',$whitepaper->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $whitepaper->title }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Type</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $whitepaper->type }}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Anchor Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $whitepaper->title_tag }}</h5>
              </div>
               </div>
                  <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image Alt Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $whitepaper->alt_tag }}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>short_description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $whitepaper->short_description !!}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                   @if($whitepaper->image)
              <a href="{{ config('app.url').'/knowledgebank/whitepaper/'.$whitepaper->pdf }}" target='_blank'>View file</a>
              @endif
                </h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Case Study Pdf</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($whitepaper->pdf)
                <a href="{{ config('app.url').'/knowledgebank/whitepaper/'.$whitepaper->pdf }}" target='_blank'>View file</a>
                @endif
                </h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $whitepaper->description !!}</h5>
              </div>
               </div>
                 <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Home Whitepapers</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($whitepaper->home_whitepapers == 1)
                    Showing on Home Page
                    @elseif($whitepaper->home_whitepapers == 0)
                    Hide on Home Page
                    @endif</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>URL</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $whitepaper->url }}</h5>
              </div>
               </div>
          
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($whitepaper->active_flag == 1)
                    Active
                    @elseif($whitepaper->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
