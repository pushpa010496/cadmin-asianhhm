<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use File;
use Session;
class CaseStudyController extends Controller
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
        $request->input('search');
        //Request::get('search'); 
        $casestudies = CaseStudy::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $casestudies = CaseStudy::orderBy('id', 'desc')->paginate(10);
         }
        $active = CaseStudy::where('active_flag', 1);
      return view('knowledgebank.casestudies.index',compact('casestudies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('knowledgebank.casestudies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(['title' =>'required|unique:case_studies',
       'pdf' =>'required|mimes:pdf|max:20000',
       'url'    =>'required',
       'sub_title'    =>'required',
       'short_description'=>'required'
       
      
   ]);
      $casestudy = new CaseStudy($request->except(['pdf','created_by','url']));

      if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('knowledgebank/casestudies'), $imageName);
        $casestudy->image = $imageName; 
        }   

      if($request->file('pdf')){
        $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('knowledgebank/casestudies'),$pdfname);
        $casestudy->pdf = $pdfname;

    }
    
    $casestudy->created_by = Auth::user()->id;
    $casestudy->url = Str::slug($request->url);
    $casestudy->home_casestudies = 0;
    $casestudy->meta_title = $request->title;
    $casestudy->meta_description = $request->short_description;
    $casestudy->save();

    return redirect()->route('casestudies.index')->with(['create_message'=>'Successfully Created','alert'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\Http\Response
     */
    public function show(CaseStudy $casestudy)
    {
      return view('knowledgebank.casestudies.show',compact('casestudy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\Http\Response
     */
    public function edit(CaseStudy $casestudy)
    {
       
        return view('knowledgebank.casestudies.edit',compact('casestudy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseStudy $casestudy)
    {
       request()->validate(['title' =>'required',
       'pdf' =>'mimes:pdf|max:20000',
       'url'=>'required',
       'sub_title'    =>'required',
       'short_description'=>'required'
      
   ]);
   

        $image_name = public_path('knowledgebank/casestudies')."/".$casestudy->pdf;
       

      if(File::exists($image_name)){
        if($request->file('pdf')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('knowledgebank/casestudies'),$imagename);
        $casestudy->pdf = $imagename;
        }
        else{
           $casestudy->pdf = $casestudy->pdf; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('pdf')->getClientOriginalName();
        request()->pdf->move(public_path('knowledgebank/casestudies'),$imagename);
        $casestudy->pdf = $imagename;
        }
        $casestudy->updated_by = Auth::user()->id;
        $casestudy->url = Str::slug($request->url);
        $casestudy->update($request->except(['pdf','updated_by','url']));
        $casestudy->meta_title = $request->title;
        $casestudy->meta_description = $request->short_description;
        if($request->file('image')){
          $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
          request()->image->move(public_path('knowledgebank/casestudies'), $imageName);
          $casestudy->image = $imageName; 
          }   
      
        $casestudy->save();
       return redirect()->route('casestudies.index')->with(['create_message'=>'Successfully Updated','alert'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseStudy $casestudy)
    {
        $casestudy->active_flag = 0;
       $casestudy->save();

       return redirect()->route('casestudies.index')->with(['create_message'=>'Success fully deactivated','alert'=>'danger']);
    }

    public function reactivate($id)
    {

        $casestudy = CaseStudy::findOrFail($id);
        $casestudy->active_flag = 1;
        $casestudy->save();

        return redirect()->route('casestudies.index')->with(['create_message', 'The casestudy ' . $casestudy->name . ' was Re-Activated.','alert'=>'success']);
    }

    public function metatag(Request $request,$casestudy)
    {


        $meta = CaseStudy::findOrFail($casestudy);
        $meta->meta_title = $request->input("meta_title");
        $meta->meta_keywords = $request->input("meta_keywords");
        $meta->meta_description = $request->input("meta_description");
        $meta->og_title = $request->input("og_title");
        $meta->og_description = $request->input("og_description");
        $meta->og_keywords = $request->input("og_keywords");
        $meta->og_image = $request->input("og_image");
        $meta->og_video = $request->input("og_video");
        $meta->meta_region = $request->input("meta_region");
        $meta->meta_position = $request->input("meta_position");
        $meta->meta_icbm = $request->input("meta_icbm");
        $meta->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Casestudies ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
