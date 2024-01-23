<?php

namespace App\Http\Controllers;

use App\TechnoTrend;
use Illuminate\Http\Request;
use \Session;
use Auth;
use App\User;
use App\Http\Requests\TechnoTrendRequest;

class TechnoTrendController extends Controller
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
        $trend = TechnoTrend::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $trend = TechnoTrend::orderBy('id', 'desc')->paginate(10);
         }
        $active = TechnoTrend::where('active_flag', 1);
        return view('knowledgebank.technotrends.index', compact('trend', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('knowledgebank.technotrends.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnoTrendRequest $request)
    {
        $trend = new TechnoTrend;
        
        if($request->file('top_image')){
            $imageName = time().'-'.$request->file('top_image')->getClientOriginalName();          
            request()->top_image->move(public_path('knowledgebank/technotrends'), $imageName);
            $trend->top_image = $imageName;    
        }
        if($request->file('pdf')){
            $pdfName =  time().'-'.$request->file('pdf')->getClientOriginalName();          
            request()->pdf->move(public_path('knowledgebank/technotrends'), $pdfName);
            $trend->pdf = $pdfName;    
        }

         $trend->title = $request->title;
         
         $trend->title_tag = $request->title_tag;
         $trend->alt_tag = $request->alt_tag;
        $trend->short_description = $request->short_description;
         $trend->description = $request->description;
         $trend->home_technotrends = $request->home_technotrends;
         $trend->url = str_slug($request->url);         
         $trend->created_by = \Auth::user()->id;
         $trend->active_flag = $request->active_flag;
         $trend->meta_title = $request->title;
         $trend->meta_description = $request->short_description;
         $trend->save();
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', 'New record created');
         return redirect()->route('technotrends.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TechnoTrend  $technoTrend
     * @return \Illuminate\Http\Response
     */
    public function show(TechnoTrend $technotrend)
    {
        
        return view('knowledgebank.technotrends.show',compact('technotrend'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TechnoTrend  $technoTrend
     * @return \Illuminate\Http\Response
     */
    public function edit(TechnoTrend $technotrend)
    {
        return view('knowledgebank.technotrends.edit',compact('technotrend'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TechnoTrend  $technoTrend
     * @return \Illuminate\Http\Response
     */
    public function update(TechnoTrendRequest $request, TechnoTrend $technotrend)
    {
     
        $path = public_path('knowledgebank/technotrends');
        if($request->file('top_image')){
            $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('top_image')->getClientOriginalName());                
                if(\File::exists($path.'/'.$technotrend->top_image)){                 
                    \File::delete($path.'/'.$technotrend->top_image);                         
                }           
            request()->top_image->move($path, $imageName);
            $technotrend->top_image = $imageName;   
        }       
         if($request->file('pdf')){
            $pdfName = preg_replace('/\s+/', '-', time().'-'.$request->file('pdf')->getClientOriginalName());                
                if(\File::exists($path.'/'.$technotrend->pdf)){                 
                    \File::delete($path.'/'.$technotrend->pdf);                         
                }           
            request()->pdf->move($path, $pdfName);
            $technotrend->pdf = $pdfName;   
        }
       

         $technotrend->title = $request->title;
         
         $technotrend->title_tag = $request->title_tag;
         $technotrend->alt_tag = $request->alt_tag;
         $technotrend->short_description = $request->short_description;
         $technotrend->description = $request->description;
         $technotrend->home_technotrends = $request->home_technotrends;
         $technotrend->url = str_slug($request->url);         
         $technotrend->updated_by = \Auth::user()->id;
         $technotrend->active_flag = $request->active_flag;
         $technotrend->meta_title = $request->title;
         $technotrend->meta_description = $request->short_description;
         $technotrend->save();

         Session::flash('message_type', 'success');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', $technotrend->title.' record updated');

         return redirect()->route('technotrends.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TechnoTrend  $technoTrend
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechnoTrend $technotrend)
    {
        $technotrend->active_flag = 0;
        $technotrend->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', 'The Techno ' . $technotrend->title . ' was De-Activated.');
        return redirect()->route('technotrends.index');
    }

    public function reactivate(TechnoTrend $technotrend)
    {
        $technotrend->active_flag = 1;
        $technotrend->save();
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Techno ' . $technotrend->title . ' was Re-Activated.');

        return redirect()->route('technotrends.index');
    }
     public function metatag(Request $request,$technotrend)
    {


        $meta = TechnoTrend::findOrFail($technotrend);
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
        Session::flash('message', 'The TechnoTrend ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
