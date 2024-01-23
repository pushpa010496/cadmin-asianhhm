<?php

namespace App\Http\Controllers;

use App\Authorguideline;
use Illuminate\Http\Request;
use File;
use Session;
use App\Http\Requests\AuthorguidelineRequest;

class AuthorguidelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $authorguideline=Authorguideline::orderBy('id', 'desc')->paginate(10);
        return view('magzine.authorguideline.index',compact('authorguideline'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('magzine.authorguideline.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorguidelineRequest $request)
    {
     
        $authorguideline = new Authorguideline();   
        
        if($request->file('image')){
        $imageName = preg_replace('/\s+/','-',time().'-guideline-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('authorguidelines/pdf/'), $imageName);
        $authorguideline->image = $imageName;  
        }

        if($request->file('pdf')){
        $pdf_Name = preg_replace('/\s+/','-',time().'-guideline-'.$request->file('pdf')->getClientOriginalName());
        request()->pdf->move(public_path('authorguidelines/pdf/'), $pdf_Name);
        $authorguideline->pdf = $pdf_Name;  
        }

        $authorguideline->title = $request->title;
        $authorguideline->title_tag = $request->title_tag;
        $authorguideline->alt_tag = $request->alt_tag;
        $authorguideline->description = $request->description;
        $authorguideline->active_flag = $request->active_flag;
        $authorguideline->created_by = \Auth::id();
        $authorguideline->url = str_slug($request->url);  
        

        $authorguideline->save();
        return redirect()->route('authorguideline.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Authorguideline  $authorguideline
     * @return \Illuminate\Http\Response
     */
    public function show(Authorguideline $authorguideline)
    {
        return view('magzine.authorguideline.show',compact('authorguideline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Authorguideline  $authorguideline
     * @return \Illuminate\Http\Response
     */
    public function edit(Authorguideline $authorguideline)
    {
        
        return view('magzine.authorguideline.edit',compact('authorguideline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Authorguideline  $authorguideline
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorguidelineRequest $request, Authorguideline $authorguideline)
    {
         
      
        $path = public_path('authorguidelines/pdf/').'/';
        if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-guideline-'.$request->file('image')->getClientOriginalName());
            if(request()->image->move($path, $imageName)){                  
                if(File::exists($path.$authorguideline->image)){                  
                    \File::delete($path.$authorguideline->image);                         
                }
                $authorguideline->image = $imageName;
            }
        }
        if($request->file('pdf')){
            if(File::exists($path.'/pdf/'.$authorguideline->pdf)){                  
                    // \File::delete($path.$authorguideline->pdf); 
                $bkp_name =  'editorial-guidelines-ahhm_'.date("Y_m_d_his").'.pdf';
                $bkpmove =  \File::copy($path.'/pdf/'.$authorguideline->pdf, $path.$bkp_name);                        
                if($bkpmove){                  
                   \File::delete($path.'/pdf/'.$authorguideline->pdf); 
                   request()->pdf->move($path.'/pdf', $authorguideline->pdf);
                      // $callender->pdf = $pdf_Name;
               }
           }else{
              request()->pdf->move($path.'/pdf/', 'editorial-guidelines-ahhm.pdf');
          }
        }

        $authorguideline->title = $request->title;
        $authorguideline->title_tag = $request->title_tag;
        $authorguideline->alt_tag = $request->alt_tag;
        $authorguideline->description = $request->description;
        $authorguideline->active_flag = $request->active_flag;
        $authorguideline->url = str_slug($request->url);  
        $authorguideline->modified_by = \Auth::id();
         
         if($authorguideline->save())  {          
            return redirect()->route('authorguideline.index');  
         }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Authorguideline  $authorguideline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authorguideline $authorguideline)
    {
         $authorguideline->active_flag = 0;
       $authorguideline->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Author Guideline '.$authorguideline->title.' deactiveted !');
         return redirect()->route('authorguideline.index');
    }

      public function reactivate(Authorguideline $authorguideline)
    {        

      $authorguideline->active_flag = 1;
      $authorguideline->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Author Guideline '.$authorguideline->title.' Activeted !');
       return redirect()->route('authorguideline.index');
    }

    public function metatag(Request $request,$authorguideline)
    {


        $meta = Authorguideline::findOrFail($authorguideline);
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
        Session::flash('message', 'The Author Guideline ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
