@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Industry Report / Show #{{$industryreport->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('industryreport.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('industryreport.edit', $industryreport->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $industryreport->date }}</h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title1</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $industryreport->title1 }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title2</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $industryreport->title2 }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Short Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $industryreport->short_description }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Author Details</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $industryreport->author_details !!}</h5>
              </div>
             </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Full Report</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $industryreport->full_report !!}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>URL</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $industryreport->url }}</h5>
              </div>
             </div>
         
           
            
          
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($industryreport->active_flag == 1)
                    Active
                    @elseif($industryreport->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
