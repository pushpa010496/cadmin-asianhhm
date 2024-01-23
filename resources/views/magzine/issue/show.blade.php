@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Issues / Show #{{$issue->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('issues.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('issues.edit', $issue->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Issue no</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $issue->issue_no }}</h5>
              </div>
             </div>

            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $issue->title }}</h5>
              </div>
             </div>
         
     
          
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Category</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $issue->category }}</h5>
              </div>
            </div>
    
        
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5> {{ $issue->active_flag == 1 ? 'Active' : 'In Active' }} </h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($issue->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($issue->created_at)) }}</h5>
              </div>
       </div>
    </div>
       
     
  
@endsection
