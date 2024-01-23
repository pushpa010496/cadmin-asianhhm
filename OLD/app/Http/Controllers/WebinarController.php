<?php

namespace App\Http\Controllers;

use App\Webinar;
use Illuminate\Http\Request;
use Auth;
use File;
use Session;

class WebinarController extends Controller
{
    protected $model;
     public function __construct(Webinar $model)
     {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->get('search')){
        $search = \Request::get('search'); 
        $data = Webinar::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $data = Webinar::orderBy('id', 'desc')->paginate(10);
         }
     
        return view('webinars.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('webinars.create');
    }

    public function store(Request $request)
    {
       request()->validate([
        'title' =>'required',
        'image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'url'=>'required',
        'speaker' =>'required',
        'speaker_designation' =>'required',
        'date' =>'required',
        'webinar_date' =>'required|date',
        
        ]);


       $webinar = new Webinar($request->except(['image']));
       if($request->file('image')){
        $webinar_image  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('webinars'),$webinar_image);
        $webinar->image = $webinar_image;
    }

    $webinar->created_by = Auth::user()->id;    
    $webinar->save();
    return redirect()->route('webinars.index')->with(['create_message'=>'Successfully Created','alert'=>'success']);
    }

  
    public function show(Webinar $webinar)
    {
      return view('webinars.show',compact('webinar'));
    }

   
    public function edit(Webinar $webinar)
    {
        return view('webinars.edit',compact('webinar'));
    }

   
    public function update(Request $request, Webinar $webinar)
    {


       request()->validate([
        'title' =>'required',
        'image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
        'url'=>'required',
        'speaker' =>'required',
        'speaker_designation' =>'required',
        'date' =>'required',
        'webinar_date' =>'required|date',
        
        ]);
        $image_name = public_path('webinars')."/".$webinar->image;


        if(File::exists($image_name)){
            if($request->file('image')){
             File::delete($image_name);
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
             request()->image->move(public_path('webinars'),$imagename);
             $webinar->image = $imagename;
            }else{
               $webinar->image = $webinar->image; 
            }
       }
       else{
            // $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
            // request()->image->move(public_path('webinars'),$imagename);
            // $webinar->image = $imagename;
        }
        $webinar->update($request->except(['image']));
        $webinar->updated_by = Auth::user()->id;            
        $webinar->save();

        return redirect()->route('webinars.index')->with(['create_message'=>'Successfully Updated','alert'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Webinar $webinar)
    {
       $webinar->active_flag = 0;
       $webinar->save();
       Session::flash('message_type', 'danger');
       Session::flash('message_icon', 'checkmark');
       Session::flash('message_header', 'Success');
       Session::flash('message', 'webinar '.$webinar->title.' deactiveted !');
       return redirect()->route('webinars.index');
   }

   public function reactivate(Webinar $webinar)
   {        

      $webinar->active_flag = 1;
      $webinar->save();
      Session::flash('message_type', 'success');
      Session::flash('message_icon', 'checkmark');
      Session::flash('message_header', 'Success');
      Session::flash('message', 'webinar '.$webinar->title.' Activeted !');
      return redirect()->route('webinars.index');
  }
}
