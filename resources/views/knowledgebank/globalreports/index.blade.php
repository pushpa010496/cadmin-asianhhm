@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i> Global Reports
            
        </h3>
    </div>
   
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

          {!! Form::open(['method'=>'GET','url'=>'globalreports','role'=>'search'])  !!}
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
        

            @if($globalreport->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                             <th class="text-center">Report Category</th>  
                            <th class="text-center">Title</th>                            
                            <th class="text-center">Publisher</th>                            
                            <th class="text-center">Publication Date</th>                            
                            <th class="text-center">Status</th>                            
                          
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>
                        @foreach($globalreport as $value)
                            <tr>
                                <td class="text-center"><h5>{{$i}}</h5></td>
                                 <td class="text-center"><h5>{{$value->category->title}}</h5></td>
                                <td class="text-center"><h5>{{$value->title}}</h5></td>
                               <td class="text-center"><h5>{{$value->publisher}}</h5></td>
                                <td class="text-center"><h5>{{ date('j F Y', strtotime($value->publication_date)) }}</h5></td>
                                <td class="text-center">
                                    <h5>
                                          @if($value->active_flag ==1) Active @elseif($value->active_flag == 0) Inactive @endif
                                    </h5>
                                </td>
                               
                            </tr><?php $i++; ?>
                            <!--modal-->

                         
                        @endforeach
                    </tbody>
                </table>
                {!! $globalreport->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection