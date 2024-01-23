@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Casestudy / Show #{{$casestudy->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('casestudies.edit', $casestudy->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $casestudy->title }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i> Sub Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $casestudy->sub_title }}</h5>
              </div>
               </div>
                 <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Anchor Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $casestudy->title_tag }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Short Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $casestudy->short_description !!}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Case Study Pdf</h5>
              </div>
              <div class="col-md-9">
                <h5>
                @if($casestudy->pdf)
              <a href="{{ config('app.url').'/knowledgebank/casestudies/'.$casestudy->pdf }}" target='_blank'>View file</a>
              @endif
                 
                </h5>
              </div>
             </div>
             
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>casestudies Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $casestudy->description !!}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Home casestudies</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($casestudy->active_flag == 1)
                    Showing on Home Page
                    @elseif($casestudy->active_flag == 0)
                    Hide on Home Page
                    @endif</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>casestudy Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $casestudy->url !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($casestudy->active_flag == 1)
                    Active
                    @elseif($casestudy->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
