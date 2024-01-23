@extends('layouts.app')


@section('header')
<div class="container">
<div class="page-header clearfix">
  <h3>
    <i class="fa fa-th-list" aria-hidden="true"></i>  Issues
    <a class="btn btn-sm btn-success pull-right" href="{{ route('issues.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>  Create</a>
  </h3>
</div>
</div>
@endsection
@section('content')
<div class="container">

 <?php //print_r($user_data); ?>
 <div class="col-md-8 col-md-offset-2">
   <div class="panel panel-default">
    {!! Form::open(['method'=>'GET','url'=>'issues','role'=>'search'])  !!}
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
    <div class="panel-heading">Issues List</div>
       
    <div class="panel-body">

      @if($data->count())
      <table class="table table-condensed table-striped">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th style="margin-left:45px">Issue Id</th> 
            <th style="margin-left:45px">Issue Name</th> 
            <th style="margin-left:45px">Status</th> 
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody><?php $i=1; ?>
          @foreach($data as $issue_data)
          <tr>
            <td class="text-center"><strong>{{$i}}</strong></td>

            <td>{{$issue_data->issue_no}}</td> 
            <td>{{$issue_data->title}}</td> 
            <td>{{ $issue_data->active_flag == 1?'Active' : 'In Active' }}</td>
            <td class="text-right">  
                                             
             <a class="btn btn-sm btn-primary" href="{{ route('issues.show', $issue_data->id) }}">

               <i class="fa fa-eye" aria-hidden="true"></i> View
             </a>

             <a class="btn btn-sm btn-info" href="{{ route('issues.edit', $issue_data->id) }}">
               <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
             </a>
             @if($issue_data->active_flag == 1 )
               <form action="{{ route('issues.destroy', $issue_data->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">

              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">

              <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
            </form>
             @else
                <a class="btn btn-sm btn-success" href="{{ url('issue/reactivate/').'/'. $issue_data->id }}">

               <i class="fa fa-redo" aria-hidden="true"></i>  Active   ?
             </a>
             @endif
            
          </td>
        </tr><?php $i++; ?>
        @endforeach
      </tbody>
    </table>
      {!! $data->render() !!}
    @else
    <h3 class="text-center alert alert-info">Empty!</h3>
    @endif
  </div>
</div>
</div>
</div>
</div>
@endsection
