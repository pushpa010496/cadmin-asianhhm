 @extends('../layouts/app')
@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i> Editorialarticle
            <a class="btn btn-sm btn-success pull-right" href="{{ route('editorialarticle.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Create</a>
        </h3>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
              {!! Form::open(['method'=>'GET','url'=>'editorialarticle','role'=>'search'])  !!}
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
            @if($data->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>                            
                            <th class="text-center"> Issue </th>     
                            <th class="text-center"> Category</th>                                                        
                            <th class="text-center">Status</th>                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>
                    <tbody><?php $i=1; ?>
                        @foreach($data as $value)
                            <tr>
                                <td class="text-center"><h5>{{$i}}</h5></td>
                                <td class="text-center"><h5>{{$value->title}}</h5></td>                               
                                <td class="text-center"><h5>{{$value->issue->issue_no}}</h5></td>
                                <td class="text-center"><h5>{{$value->category->name}}</h5></td>
                                <td class="text-center"><h5>{{$value->active_flag == 1 ? 'Active': 'In Active'}}</h5></td>             
                                <td class="text-right">
                                     <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal{{$value->id}}"> Update Metatags ?</button>                           
                                    <a class="btn btn-sm btn-primary" href="{{ route('editorialarticle.show', $value->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    <a class="btn btn-sm btn-info" href="{{ route('editorialarticle.edit', $value->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>
                                    @if($value->active_flag == 1 )
                                    <form action="{{ route('editorialarticle.destroy', $value->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                                    </form>
                                    @else 
                                         <a class="btn btn-sm btn-success" href="{{ url('editorialarticle/reactivate', $value->id) }}">
                                        <i class="fa fa-check fa-2" aria-hidden="true"></i> Active
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
                                          {!! Form::open(array('url'=>'editorialarticle/metatag/'.$value->id)) !!}
                                             @includeIf('./seoform')
                                          {!! Form::close() !!}
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
                {!! $data->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif
        </div>
    </div>
    
@endsection