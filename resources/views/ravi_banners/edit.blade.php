@extends('layouts/app')

@section('header')
    <div class="page-header"> 
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Editorial / Category </h3>
    </div>
@endsection

@section('content')


   

                      <div class="row">
                      <div class="col-md-offset-3 col-md-6">
          
                    
       {{ Form::model($banner, ['route' => ['banners.update', $banner->id],'method' => 'PUT']) }}

                @csrf   
        
               
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text','title', null,['class' => 'form-control']) }}                    
                </div>
                <div class="form-group">
                    {!! Form::label('bannerurl', 'Banner Url:') !!}
                    {{ Form::input('text','url', null,['class' => 'form-control']) }}                    
                </div>

                <div class="form-group">
                    {!!Form::label('anchor title tag', 'Anchor Title Tag:') !!}

title_tag
                     {{Form::input('text','title_tag', null,['class' => 'form-control']) }}   
                                      
                </div>

                
               

                <div class="form-group">
                    {!! Form::label('Image Alt tag', 'Image Alt Tag:') !!}
                    {{ Form::input('text','alt_tag', null,['class' => 'form-control']) }}                    
                </div>
                <div class="form-group">
                    {!! Form::label('position', 'Position:') !!}
                    {{  Form::select('position', array('1' => 'Leaderboard Banner', '2' => 'Square Banner','3' => 'Prime Banner 1', '4' => 'Prime Banner 2','5' => 'Prime Banner 3', '6' => 'Home Top Banner','7' => 'Home Middle Banner', '8' => 'Home Bottom Banner'), 'S',['class' => 'form-control'])    }}                
                </div>

                <div class="form-group">
                    {!! Form::label('bannerpages', 'Banner Pages:') !!}
                    {{  Form::select('pages', array('1' => 'Active', '0' => 'In Active'), 'S',['class' => 'form-control'])    }}                
                </div>
                

                <div class="form-group">
                    {!! Form::label('type', 'Type:') !!}
                    {{  Form::select('type', array('1' => 'Image', '2' => 'Flash', '3' => 'Banner Script'), 'S',['class' => 'form-control'])    }}                
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status:') !!}
                    {{  Form::select('status', array('1' => 'Active', '0' => 'In Active'), 'S',['class' => 'form-control'])    }}                
                </div>


                 <div class="form-group">
                    {{ Form::submit('Create'),['class'=> 'btn btn-primary'] }}               
                </div>


                

 

{!! Form::close() !!}
                      

        </div>
    </div>
@endsection

@section('scripts')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description');
</script>

@endsection

