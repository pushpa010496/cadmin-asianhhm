@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i> News
            <a class="btn btn-sm btn-success pull-right" href="{{ route('newsone.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create</a>
        </h3>
    </div>
   
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

          {!! Form::open(['method'=>'GET','url'=>'news','role'=>'search'])  !!}
              <div id="custom-search-input">
                <div class="input-group col-md-12 pull-right">
                    <input type="text" class="search-query form-control" placeholder="Search" name="search" />
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button">
                            <i class="fa fa-search" aria-hidden="true"></i>

                        </button>
                    </span>
                </div>
              </div>
         {!! Form::close() !!}
        

            @if($news->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>                            
                            <th class="text-center">Date</th>                            
                            <th class="text-center">Status</th>                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>
                        @foreach($news as $value)
                            <tr>
                                <td class="text-center"><h5>{{$i}}</h5></td>
                                <td class="text-center"><h5>{{$value->title}}</h5></td>
                               
                                <td class="text-center"><h5>{{ date('j F Y', strtotime($value->date)) }}</h5></td>
                                <td class="text-center">
                                    <h5>
                                          @if($value->active_flag ==1) Active @elseif($value->active_flag == 0) Inactive @endif
                                    </h5>
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal{{$value->id}}"> Update Metatags ?</button>
                                    
                                    <a class="btn btn-sm btn-success" href="{{ url('news/reactivate', $value->id) }}">
                                         Active ?
                                    </a>

                                    <a class="btn btn-sm btn-primary" href="{{ route('newsone.show', $value->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    
                                    <a class="btn btn-sm btn-info" href="{{ route('newsone.edit', $value->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>
                                     @if($value->active_flag == 1 )
                                    <form action="{{ route('newsone.destroy', $value->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                                    </form>
                                    @else 
                                         <a class="btn btn-sm btn-success" href="{{ url('news/reactivate', $value->id) }}">
                                         Active ?
                                    </a>
                                    @endif
                                </td>
                            </tr><?php $i++; ?>
                            <!--modal-->

                            <div id="myModal{{$value->id}}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Update Metatags</h4>
                                      </div>
                                      <div class="modal-body">
                                         <div class="modal-body">
                                             
                                             {{'hi'}}

                                             
                                          {!! Form::open(array('url'=>'/news/metatag/'.$value->id)) !!}
                                             @includeIf('./seoform')
                                             
                                          {!! Form::close() !!}
                                      </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                        @endforeach
                    </tbody>
                </table>
                {!! $news->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection