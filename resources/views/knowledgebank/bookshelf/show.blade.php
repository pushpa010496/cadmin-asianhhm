@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Book Shelf / Show #{{$bookshelf->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('bookshelf.edit', $bookshelf->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
           
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>bookshelf Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $bookshelf->title }}</h5>
              </div>
               </div>
                <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Sub Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $bookshelf->sub_title }}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Author Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $bookshelf->authors }}</h5>
              </div>
               </div>
                 <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Anchor Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $bookshelf->title_tag }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($bookshelf->bookshelf_image)
                  <img width="200" src="<?php echo config('app.url'); ?>/knowledgebank/bookshelf/<?php echo $bookshelf->bookshelf_image;?>">
                  @endif
                </h5>
              </div>
             </div>
             
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>bookshelf Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $bookshelf->url !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($bookshelf->active_flag == 1)
                    Active
                    @elseif($bookshelf->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
