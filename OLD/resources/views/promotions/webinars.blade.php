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
                    <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                          <th style="width:2%">#</th> 
                            <th style="width:5%">firstname</th>                           
                            <th style="width:5%">lastname</th>     
                            <th style="width:5%">email</th>     
                            <th style="width:5%">job_title</th> 
                            <th style="width:5%">company</th>
                            <th style="width:5%">address1</th>
                            <th style="width:5%">address2</th>
                            <th style="width:5%">country</th>
                            <th style="width:5%">city</th>
                            <th style="width:5%">state</th>
                            <th style="width:5%">zip</th>
                             <th style="width:5%">Phone</th>
                             <th style="width:5%">email_updates</th>
                             <th style="width:5%">representative</th>
                             <th style="width:5%">quotation</th>
                             <th style="width:5%">created_at</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>

                        @foreach($leadsinfo as $value)
                       
                            <tr>
                               <td style="width:2%">{{$i}}</td>
                               <td style="width:5%">{{$value->firstname}}</td>
                               <td style="width:5%">{{$value->lastname}}</td>
                               <td style="width:5%">{{$value->email}}</td>
                               <td style="width:5%">{{$value->job_title}}</td>
                               <td style="width:5%">{{$value->company}}</td>

                               <td style="width:5%">{{$value->address1}}</td> 
                               <td style="width:5%">{{$value->address2}}</td>
                               <td style="width:5%">{{$value->country}}</td>
                               <td style="width:5%">{{$value->city}}</td>
                               <td style="width:5%">{{$value->state}}</td>
                               <td style="width:5%">{{$value->zip}}</td>
                               <td style="width:5%">{{$value->phone}}</td>
                               <td style="width:5%">{{$value->email_updates}}</td>
                               <td style="width:5%">{{$value->representative}}</td>
                               <td style="width:5%">{{$value->quotation}}</td>
                               <td style="width:5%">{{$value->created_at}}</td>

                             
                               
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
</div>
@endsection