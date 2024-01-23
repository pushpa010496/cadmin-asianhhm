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
                            <th style="width:5%">Name</th>                           
                            <th style="width:5%">Email</th>     
                            <th style="width:5%">Job Title</th>     
                            <th style="width:5%">phone</th>
                             <th style="width:5%">Generated Date</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>

                        @foreach($leadsinfo as $value)
                       
                            <tr>
                                 <td style="width:2%">{{$i}}</td>
                                <td style="width:5%">{{$value->fullname}}</td>
                                <td style="width:5%">{{@$value->email}}</td>
                                <td style="width:5%">{{@$value->designation}}</td>
                                <td style="width:5%">{{@$value->telephone}}</td>
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