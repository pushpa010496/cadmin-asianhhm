<?php

namespace App\Http\Controllers;

use App\TechSpace;
use Illuminate\Http\Request;
use Auth;
use File;
class TechSpaceController extends Controller
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
        $techspec = TechSpace::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $techspec = TechSpace::orderBy('id', 'desc')->paginate(10);
         }
        $active = TechSpace::where('active_flag', 1);

        return view('techspec.index',compact('techspec'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('techspec.create');
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
       'sub_title'=>'required'
   ]);

      $techspec = new TechSpace($request->except(['target_url','image','pdf','author_id']));
      if($request->file('image')){
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('techspec'),$imagename);
        $techspec->image = $imagename;

    }

    if($request->file('pdf')){
        $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('techspec'),$pdfname);
        $techspec->pdf = $pdfname;

    }
    $techspec->author_id = Auth::user()->id;
    $techspec->target_url =str_slug($request->target_url);
    $techspec->save();

    return redirect()->route('techspec.index')->with(['create_message'=>'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TechSpace  $techSpace
     * @return \Illuminate\Http\Response
     */
    public function show(TechSpace $techspec)
    {
        return view('techspec.show',compact('techspec'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TechSpace  $techSpace
     * @return \Illuminate\Http\Response
     */
    public function edit(TechSpace $techspec)
    {
       return view('techspec.edit',compact('techspec'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TechSpace  $techSpace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TechSpace $techspec)
    {
       request()->validate
      (['title' =>'required',
       'image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'pdf' =>'mimes:pdf|max:100000',
       'target_url'=>'required',
       'sub_title'=>'required'
   ]);

       $image_name = public_path('techspec')."/".$techspec->image;
       $pdf_name = public_path('techspec')."/".$techspec->pdf;

      if(File::exists($image_name)){
        if($request->file('image')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('techspec'),$imagename);
        $techspec->image = $imagename;
        }
        else{
           $techspec->image = $techspec->image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('techspec'),$imagename);
        $techspec->image = $imagename;
        }

     if(File::exists($pdf_name)){
        if($request->file('pdf')){
         File::delete($pdf_name);
        $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('techspec'),$pdfname);
        $techspec->pdf = $pdfname;
        }
        else{
           $techspec->pdf = $techspec->pdf; 
        }
        }
        else{
            
             $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('techspec'),$pdfname);
        $techspec->pdf = $pdfname;
        }
    $techspec->author_id = Auth::user()->id;
    $techspec->target_url =str_slug($request->target_url);
    $techspec->update($request->except(['image','pdf','author_id','target_url']));
    $techspec->save();
       return redirect()->route('techspec.index')->with(['create_message'=>'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TechSpace  $techSpace
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechSpace $techspec)
    {
       $techspec->active_flag = 0;
       $techspec->save();

       return redirect()->route('techspec.index')->with(['create_message'=>'Success fully deactivated']);
    }

    public function reactivate($id)
    {

        $techspec = TechSpace::findOrFail($id);
        $techspec->active_flag = 1;
        $techspec->save();

        return redirect()->route('techspec.index')->with('create_message', 'The Techspec ' . $techspec->name . ' was Re-Activated.');
    }
}
