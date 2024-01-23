@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Ebook / Show #{{$ebook->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('ebooks.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('ebooks.edit', $ebook->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
          <div class="col-md-6">
             <h5 class="text-primary"><i class="role icon"></i>Issue No</h5>
              <h5>{{ $ebook->issue->issue_no }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Title</h5>
            <h5>{{$ebook->title }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Magazine Image</h5>
            <img src="{{ config('app.url').'ebooks/'. str_slug($ebook->issue->issue_no).'/'. $ebook->magazine_image}}" class="img-responsive">
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Ebook Image</h5>
            <img src="{{ config('app.url').'ebooks/'.str_slug($ebook->issue->issue_no).'/'.$ebook->ebook_image }}" class="img-responsive">
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
            <h5>{{$ebook->title_tag }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
            <h5>{{$ebook->alt_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Ebook Script</h5>
            <h5>{{$ebook->ebook_script }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Ebook Script Home </h5>
            <h5>{{$ebook->ebook_script_home }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Topic 1 </h5>
            <h5>{{$ebook->topic_1 }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Topic 2 </h5>
            <h5>{{$ebook->topic_2 }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Topic 3 </h5>
            <h5>{{$ebook->topic_3 }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Topic 4 </h5>
            <h5>{{$ebook->topic_4 }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Topic 5</h5>
            <h5>{{$ebook->topic_5 }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Topic 6 </h5>
            <h5>{{$ebook->topic_6 }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>URL </h5>
            <h5>{{$ebook->url }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Status </h5>
            <h5>{{$ebook->active_flag == 1 ? 'Active':'In Active' }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
              <h5>{{ date('j F Y', strtotime($ebook->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($ebook->created_at)) }}</h5>
          </div>


          {{-- row end --}}
        </div>
        
       </div>
        
     
  
@endsection
