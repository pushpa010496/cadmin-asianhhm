@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Projects / Show #{{$project->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('project.edit', $project->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->title }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Anchor Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->title_tag }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Anchor Alt Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->alt_tag }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Short Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $project->short_description !!}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Project Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $project->description !!}</h5>
              </div>
               </div>

            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Project Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                   @if($project->image)
                  <img width="200" src="<?php echo config('app.url'); ?>/knowledgebank/project/<?php echo $project->image;?>">
                  @endif
                  
                  
                </h5>
              </div>
             </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Project Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->project_name }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Location</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->location }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Commencement</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->commence }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Completion</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->completion }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Estimated Investement</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->est_inv }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Capacity</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->capacity }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Key Players</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $project->key_player }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>project Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $project->url !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($project->active_flag == 1)
                    Active
                    @elseif($project->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
