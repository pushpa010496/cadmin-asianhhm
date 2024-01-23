<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;


class GlobalReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
     
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
      
        if($request->get('search')){
        $search = \Request::get('search'); 
        $globalreport = Report::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $globalreport = Report::orderBy('id', 'desc')->paginate(10);
         }
        $active = Report::where('active_flag', 1);
   
           return view('knowledgebank.globalreports.index',compact('globalreport'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
