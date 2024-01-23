<?php

namespace App\Http\Controllers;

use App\Models\TargetAudience;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use File;
class TargetAudienceController extends Controller
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
        $targetaudience = TargetAudience::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $targetaudience = TargetAudience::orderBy('id', 'desc')->paginate(10);
         }
        $active = TargetAudience::where('active_flag', 1);

        return view('targetaudience.index',compact('targetaudience'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('targetaudience.create');
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
       'pdf' =>'required|mimes:pdf|max:20000',
       'target_url'=>'required',
       'description'=>'required'
   ]);

      $targetaudience = new TargetAudience($request->except(['image','pdf','author_id','target_url']));
      if($request->file('image')){
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('targetaudience'),$imagename);
        $targetaudience->image = $imagename;

    }
    if($request->file('pdf')){
        $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('targetaudience'),$pdfname);
        $targetaudience->pdf = $pdfname;

    }
    $targetaudience->author_id = Auth::user()->id;
    $targetaudience->target_url = Str::slug($request->target_url);
    $targetaudience->save();

    return redirect()->route('targetaudience.index')->with(['create_message'=>'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TargetAudience  $targetAudience
     * @return \Illuminate\Http\Response
     */
    public function show(TargetAudience $targetaudience)
    {
      return view('targetaudience.show',compact('targetaudience'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TargetAudience  $targetAudience
     * @return \Illuminate\Http\Response
     */
    public function edit(TargetAudience $targetaudience)
    {
       return view('targetaudience.edit',compact('targetaudience'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TargetAudience  $targetAudience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TargetAudience $targetaudience)
    {
        request()->validate
      (['title' =>'required|unique:target_markets',
       'image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'pdf' =>'mimes:pdf|max:200000',
       'target_url'=>'required',
        'description'=>'required'
   ]);
       $image_name = public_path('targetaudience')."/".$targetaudience->image;
       $pdf_name = public_path('targetaudience')."/".$targetaudience->pdf;

      if(File::exists($image_name)){
        if($request->file('image')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('targetaudience'),$imagename);
        $targetaudience->image = $imagename;
        }
        else{
           $targetaudience->image = $targetaudience->image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('targetaudience'),$imagename);
        $targetaudience->image = $imagename;
        }

     if(File::exists($pdf_name)){
        if($request->file('pdf')){
         File::delete($pdf_name);
        $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('targetaudience'),$pdfname);
        $targetaudience->pdf = $pdfname;
        }
        else{
           $targetaudience->pdf = $targetaudience->pdf; 
        }
        }
        else{
            
             $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('targetaudience'),$pdfname);
        $targetaudience->pdf = $pdfname;
        }

    $targetaudience->author_id = Auth::user()->id;
    $targetaudience->target_url =Str::slug($request->target_url);
    $targetaudience->update($request->except(['image','pdf','author_id','target_url']));
    $targetaudience->save();
       return redirect()->route('targetaudience.index')->with(['create_message'=>'Successfully Updated']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TargetAudience  $targetAudience
     * @return \Illuminate\Http\Response
     */
    public function destroy(TargetAudience $targetaudience)
    {
       $targetaudience->active_flag = 0;
       $targetaudience->save();

       return redirect()->route('targetaudience.index')->with(['create_message'=>'Success fully deactivated']);
    }

    public function reactivate($id)
    {

        $targetaudience = TargetAudience::findOrFail($id);
        $targetaudience->active_flag = 1;
        $targetaudience->save();

        return redirect()->route('targetaudience.index')->with('create_message', 'The Targetaudience ' . $targetaudience->name . ' was Re-Activated.');
    }
}
