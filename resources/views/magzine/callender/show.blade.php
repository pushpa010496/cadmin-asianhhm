@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Callender / Show #{{$callender->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('callender.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('callender.edit', $callender->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
         
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Title</h5>
            <h5>{{$callender->title }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Sub Title</h5>
            <h5>{{$callender->sub_title }}</h5>
          </div>
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>URL </h5>
            <h5>{{$callender->url }}</h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i> Image</h5>
            <img src="{{ config('app.url').'callender/'. $callender->image}}" class="img-responsive">
          </div>
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>PDF</h5>
            @if($callender->pdf)
            <a href="{{ config('app.url').'callender/'.$callender->pdf }}" target='_blank'>View file</a>
            @endif
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
            <h5>{{$callender->title_tag }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
            <h5>{{$callender->alt_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Description</h5>
            <h5>{{$callender->description }}</h5>
          </div>

          

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Status </h5>
            <h5>{{$callender->active_flag == 1 ? 'Active':'In Active' }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
              <h5>{{ date('j F Y', strtotime($callender->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($callender->created_at)) }}</h5>
          </div>


          {{-- row end --}}
        </div>
        
       </div>
        
     
  
@endsection
