<?php

namespace App\Http\Controllers;

use App\TargetMarket;
use Illuminate\Http\Request;
use Auth;
use File;
class TargetMarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->get('search')){
        $search = Request::get('search'); 
        $targetmarket = TargetMarket::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $targetmarket = TargetMarket::orderBy('id', 'desc')->paginate(10);
         }
        $active = TargetMarket::where('active_flag', 1);

        return view('targetmarket.index',compact('targetmarket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('targetmarket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      request()->validate
      (['title' =>'required|unique:target_markets',
       'image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
       'pdf' =>'required|mimes:pdf|max:10000',
       'target_url'=>'required',
       'sub_title'=>'required',
       'description'=>'required',
       'alt_tag'=>'required',
   ]);

      $targetmarket = new TargetMarket($request->except(['image','pdf','author_id','target_url']));
      if($request->file('image')){
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('targetmarket'),$imagename);
        $targetmarket->image = $imagename;

    }
    if($request->file('pdf')){
        $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('targetmarket'),$pdfname);
        $targetmarket->pdf = $pdfname;

    }
    $targetmarket->author_id = Auth::user()->id;
    $targetmarket->target_url = str_slug($request->target_url); 
    $targetmarket->save();

    return redirect()->route('targetmarket.index')->with(['create_message'=>'Successfully Created']);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\TargetMarket  $targetMarket
     * @return \Illuminate\Http\Response
     */
    public function show(TargetMarket $targetmarket)
    {
       return view('targetmarket.show',compact('targetmarket'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TargetMarket  $targetMarket
     * @return \Illuminate\Http\Response
     */
    public function edit(TargetMarket $targetmarket)
    {
       return view('targetmarket.edit',compact('targetmarket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TargetMarket  $targetMarket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TargetMarket $targetmarket)
    {
       request()->validate
      (['title' =>'required',
       'image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'pdf' =>'mimes:pdf|max:10000',
       'target_url'=>'required',
       'sub_title'=>'required',
        'description'=>'required',
        'alt_tag'=>'required',
   ]);


       $image_name = public_path('targetmarket')."/".$targetmarket->image;
       $pdf_name = public_path('targetmarket')."/".$targetmarket->pdf;
      

      if(File::exists($image_name)){
        if($request->file('image')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('targetmarket'),$imagename);
        $targetmarket->image = $imagename;
        }
        else{
           $targetmarket->image = $targetmarket->image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('targetmarket'),$imagename);
        $targetmarket->image = $imagename;
        }

     if(File::exists($pdf_name)){
        if($request->file('pdf')){
         File::delete($pdf_name);
        $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('targetmarket'),$pdfname);
        $targetmarket->pdf = $pdfname;
        }
        else{
           $targetmarket->pdf = $targetmarket->pdf; 
        }
        }
        else{
            
             $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('targetmarket'),$pdfname);
        $targetmarket->pdf = $pdfname;
        }

    $targetmarket->author_id = Auth::user()->id;
    $targetmarket->target_url = str_slug($request->target_url); 
    $targetmarket->update($request->except(['image','pdf','author_id','target_url']));
    $targetmarket->save();
       return redirect()->route('targetmarket.index')->with(['create_message'=>'Successfully Updated']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TargetMarket  $targetMarket
     * @return \Illuminate\Http\Response
     */
    public function destroy(TargetMarket $targetmarket)
    {
       $targetmarket->active_flag = 0;
       $targetmarket->save();

       return redirect()->route('targetmarket.index')->with(['create_message'=>'Success fully deactivated']);
    }

    public function reactivate($id)
    {

        $targetmarket = TargetMarket::findOrFail($id);
        $targetmarket->active_flag = 1;
        $targetmarket->save();

        return redirect()->route('targetmarket.index')->with('message', 'The Targetmarket ' . $targetmarket->name . ' was Re-Activated.');
    }
}
