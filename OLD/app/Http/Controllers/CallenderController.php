<?php

namespace App\Http\Controllers;

use App\Callender;
use Illuminate\Http\Request;
use File;
use Session;
use App\Http\Requests\CallenderRequest;

class CallenderController extends Controller
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
            
            $callenders = Callender::where('title', 'like', '%'.$search.'%')->paginate(20);
        }else{
            $callenders = Callender::orderBy('id', 'desc')->paginate(10);
        }
        $active = Callender::where('active_flag', 1);

       // $callenders=Callender::orderBy('id', 'desc')->paginate(10);
        return view('magzine.callender.index',compact('callenders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('magzine.callender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CallenderRequest $request)
    {
        
        
        $callender = new Callender($request->except('image','pdf','url'));   
        if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-callender-'.$request->file('image')->getClientOriginalName());
            request()->image->move(public_path('callender'), $imageName);
            $callender->image = $imageName;  
        }

        if($request->file('pdf')){
        // $pdf_Name = preg_replace('/\s+/','-',time().'-callender-'.$request->file('pdf')->getClientOriginalName());
            $pdf_Name = 'asian-hospital-healthcare-management-editorial-calendar.pdf';            
            request()->pdf->move(public_path('callender').'/pdf', $pdf_Name);
            $callender->pdf = $pdf_Name;  
        }
        $callender->url = str_slug($request->url);  
        $callender->created_by = \Auth::id();  

        $callender->save();
        return redirect()->route('callender.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Callender  $callender
     * @return \Illuminate\Http\Response
     */
    public function show(Callender $callender)
    {
        return view('magzine.callender.show',compact('callender'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Callender  $callender
     * @return \Illuminate\Http\Response
     */
    public function edit(Callender $callender)
    {
     return view('magzine.callender.edit',compact('callender'));
 }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Callender  $callender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Callender $callender)
    {     

        $path= public_path('callender').'/';

        // $callender = Callender::findOrFail($id);
        

        /*if($request->file('image')){
            
            $imageName = preg_replace('/\s+/','-',time().'-callender-'.$request->file('image')->getClientOriginalName());
            if(request()->image->move($path, $imageName)){                  
            if(File::exists($path.$callender->image)){                  
                    \File::delete($path.$callender->image);
                }
            $callender->image = $imageName;
            }
        }*/

        if($request->file('pdf')){
            
          if(File::exists($path.'pdf/'.$callender->pdf)){          
                    // \File::delete($path.$callender->pdf); 
            $bkp_name =  'asian-hospital-healthcare-management-editorial-calendar_'.date("Y_m_d_his").'.pdf';
            $bkpmove =  \File::copy($path.'pdf/'.$callender->pdf, $path.$bkp_name);                        
            if($bkpmove){
              
               \File::delete($path.'/pdf/'.$callender->pdf); 
               request()->pdf->move($path.'/pdf', $callender->pdf);
                      // $callender->pdf = $pdf_Name;
           }
       }else{
          request()->pdf->move($path.'/pdf/', 'asian-hospital-healthcare-management-editorial-calendar.pdf');
      }
      
  }
  

  $callender->url = str_slug($request->url);                   
  $callender->update($request->except('image','pdf','url'));
  $callender->modified_by = \Auth::id();  
  if($callender->save())  {          
    return redirect()->route('callender.index');
}  
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Callender  $callender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Callender $callender)
    {
        $callender->active_flag = 0;
        $callender->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Callender '.$callender->title.' deactiveted !');
        return redirect()->route('callender.index');
    }

    public function reactivate(Callender $callender)
    {        

      $callender->active_flag = 1;
      $callender->save();
      Session::flash('message_type', 'success');
      Session::flash('message_icon', 'checkmark');
      Session::flash('message_header', 'Success');
      Session::flash('message', 'Callender '.$callender->title.' Activeted !');
      return redirect()->route('callender.index');
  }
}
