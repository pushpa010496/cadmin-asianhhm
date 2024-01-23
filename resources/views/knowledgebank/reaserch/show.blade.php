@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Reaserch Insites / Show #{{$reaserchinsite->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('reaserchinsites.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('reaserchinsites.edit', $reaserchinsite->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
          <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $reaserchinsite->title }}</h5>
              </div>
             </div>

                 <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Sub Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $reaserchinsite->sub_title }}</h5>
              </div>
             </div>

               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $reaserchinsite->title_tag }}</h5>
              </div>
             </div>

            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Published Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $reaserchinsite->published_date }}</h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Short Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $reaserchinsite->short_description !!}</h5>
              </div>
             </div>
          
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Author Details</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $reaserchinsite->author_details !!}</h5>
              </div>
             </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $reaserchinsite->description !!}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Home Research</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($reaserchinsite->on_home == 1)
                   Showing on Home Page
                    @elseif($reaserchinsite->on_home == 0)
                    Hide on Home Page
                    @endif
                 </h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>URL</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $reaserchinsite->url }}</h5>
              </div>
             </div>
         
           
            
          
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($reaserchinsite->active_flag == 1)
                    Active
                    @elseif($reaserchinsite->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
