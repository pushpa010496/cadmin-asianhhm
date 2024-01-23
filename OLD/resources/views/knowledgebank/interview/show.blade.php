@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Interview / Show #{{$interview->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('interview.edit', $interview->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $interview->name }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Designation</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $interview->designation }}</h5>
              </div>
               </div>
                 <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $interview->title }}</h5>
              </div>
               </div>
                 <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $interview->description !!}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Home interviews</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($interview->home_interview == 1)
                    Showing on Home Page
                    @elseif($interview->home_interview == 0)
                    Hide on Home Page
                    @endif</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Add Question</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $interview->quest_answer !!}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Anchor Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $interview->title_tag }}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image Alt Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $interview->alt_tag }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($interview->photo)
                  <img width="200" src="<?php echo config('app.url'); ?>/knowledgebank/interview/<?php echo $interview->photo;?>">
                  @endif
                </h5>
              </div>
             </div>
             
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>interview Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $interview->url !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($interview->active_flag == 1)
                    Active
                    @elseif($interview->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
