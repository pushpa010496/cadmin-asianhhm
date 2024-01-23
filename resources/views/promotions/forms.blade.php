@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Leads </div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status') }}
                        </div>
                    @endif

                    <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                          <th style="width:2%">#</th> 
                            <th style="width:5%">FirstName</th>  
                            <th style="width:5%">LastName</th>                           
                            <th style="width:5%">Email</th>     
                            <th style="width:5%">Title</th>     
                            <th style="width:5%">Company</th> 
                            <th style="width:5%">Country</th>
                            <th style="width:5%">phone</th>
                             <th style="width:5%">Generated Date</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>

                        @foreach($leads_form as $value)
                       
                            <tr>
                                 <td style="width:2%">{{$i}}</td>
                                <td style="width:5%">{{@$value->firstname }}</td>
                                <td style="width:5%">{{@$value->lastname}}</td>
                                <td style="width:5%">{{@$value->email}}</td>
                                <td style="width:5%">{{@$value->job_title}}</td>
                                <td style="width:5%">{{@$value->company}}</td>
                                <td style="width:5%">{{@$value->country}}</td>
                                <td style="width:5%">{{@$value->phone}}</td>
                                <td style="width:5%">{{@$value->created_at}}</td>
                             
                               
                            </tr><?php $i++; ?>


                              <!-- Modal -->
                            

                        @endforeach

                    
                    </tbody>



                </table>



                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection