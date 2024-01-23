<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Session;
use App\Models\AdPrint;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->get('search')){
        $search = \Request::get('search'); 
        $prints = AdPrint::where('title', 'like', '%'.$search.'%')->paginate(20);

        
         }else{
            $prints = AdPrint::orderBy('id', 'desc')->paginate(10);
             
         }
        $active = AdPrint::where('active_flag', 1);
        return view('print.index', compact('prints','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('print.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);
        
       $print = new AdPrint($request->except('image'));
       if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('print'), $imageName);
        $print->image = $imageName;  
        }  
       $print->save();

       return redirect()->route('print.index')->with(['create_message'=>'successfully Created']);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $print = AdPrint::find($id);
       //print_r($print); die;
      return view('print.show',compact('print'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $print = AdPrint::find($id);
        
      return view('print.edit',compact('print'));
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
       
         request()->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);
       $print = AdPrint::find($id);
        if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('print'), $imageName);
        $print->image = $imageName;  
        }
        
         
        $print->title = ucfirst($request->input("title"));
        $print->sub_title = ucfirst($request->input("sub_title"));
        $print->title_tag = ucfirst($request->input("title_tag"));
        $print->alt_tag = ucfirst($request->input("alt_tag"));
        $print->description = ucfirst($request->input("description"));
        $print->active_flag = $request->input("active_flag");
        $print->author_id = $request->user()->id;
        $print->save();
       return redirect()->route('print.index')->with(['create_message'=>'successfully Updated']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $print = AdPrint::find($id);
        $print->active_flag = 0;
        $print->save();

        
        Session::flash('create_message', 'The print ' . $print->name . ' was De-Activated.');

        return redirect()->route('print.index')->with('create_message', 'The print ' . $print->name . ' was De-Activated.');
    }
        public function reactivate($id)
    {

        $print = AdPrint::findOrFail($id);
        $print->active_flag = 1;
        $print->save();

       
        Session::flash('create_message', 'The print ' . $print->name . ' was Re-Activated.');

        return redirect()->route('print.index')->with('create_message', 'The print ' . $print->name . ' was Re-Activated.');
    }
}
