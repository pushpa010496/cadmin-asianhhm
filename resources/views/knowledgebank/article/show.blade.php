@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Article / Show #{{$article->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{URL::previous()}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('article.edit', $article->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $article->title }}</h5>
              </div>
             </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Sub Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $article->sub_title }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Abstract</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $article->abstract !!}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Short Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $article->short_description !!}</h5>
              </div>
               </div>
               <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Home Short Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $article->home_short_description !!}</h5>
              </div>
               </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Anchor Title Tag</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $article->title_tag }}</h5>
              </div>
             </div>
              <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Author Name</h5>
              </div>
              <div class="col-md-9">
                <h5>
                @foreach($article->authors()->get() as $author)
                <h5>{{$author->title }}</h5>
                @endforeach
                </h5>
              </div>
               </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Main Body</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $article->main_body !!}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Article Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $article->url !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="print icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($article->active_flag == 1)
                    Active
                    @elseif($article->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
           
    </div>
       
     
  
@endsection
