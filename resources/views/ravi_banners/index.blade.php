@extends('layouts.app')
 
        
@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>  User   
            <a class="btn btn-sm btn-success pull-right" href="{{ route('banners.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>  Create</a>
        </h3>
     
    </div>
       <span>
{!! Form::open(['method'=>'GET','url'=>'news','role'=>'search'])  !!}
              <div id="custom-search-input">
                <div class="input-group col-md-3 pull-right">
                    <input type="text" class="search-query form-control" placeholder="Search" name="search" />
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button">
                            <i class="fa fa-search" aria-hidden="true"></i>

                        </button>
                    </span>
                </div>
              </div>
         {!! Form::close() !!}
</span>
@endsection
@section('content')
<div class="container">
    
         <?php //print_r($user_data); ?>
        <div class="col-md-8 col-md-offset-2">
               <div class="panel panel-default">
                <div class="panel-heading">Editorial Category Information

                </div>

                <div class="panel-body">
                    @if($data->count())
                <table class="table table-condensed table-striped">
                            <thead>
                              <tr>
                                  <th class="text-center">#</th>
                                  <th style="margin-left:45px">Banner Title</th> 
                                  <th style="margin-left:45px">Position</th> 
                                  <th style="margin-left:45px">Type</th> 
                                  <th class="text-right">Action</th>
                              </tr>
                            </thead>

                                      <tbody><?php $i=1; ?>
                                      @foreach($data as $banner_data)
                                      <tr>
                                      <td class="text-center"><strong>{{$i}}</strong></td>

                                      <td>{{$banner_data->title}}</td>

                                      <td>{{$banner_data->position}}</td>

                                      <td>{{$banner_data->type}}</td> 
                                      <td class="text-right">
                                    

                                       <a class="btn btn-sm btn-primary" href="{{ route('editorialcategory.show', $banner_data->id) }}">
                                      
                                       <i class="fa fa-eye" aria-hidden="true"></i> View
                                       </a>
                                    
                                      <a class="btn btn-sm btn-info" href="{{ route('banners.edit', $banner_data->id) }}">
                                       <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                      </a>

                <form action="{{ route('banners.destroy',$banner_data->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                 </form>



                                </td>
                            </tr><?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
