<?php

namespace App\Http\Controllers;

use App\AdvaisoryBoard;
use Illuminate\Http\Request;
use App\Http\Requests\AdvaisoryBoardRequest;
use File;
use Auth;
use Session;

class AdvaisoryBoardController extends Controller
{
    protected $model;
    public function __construct(AdvaisoryBoard $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if($request->get('search')){
        $search = \Request::get('search'); 
        $advaisoryboard = AdvaisoryBoard::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $advaisoryboard = AdvaisoryBoard::orderBy('id', 'desc')->paginate(10);
         }

          // $active = AdvaisoryBoard::where('active_flag', 1);

        // $advaisoryboard=AdvaisoryBoard::orderBy('id', 'desc')->paginate(10);
        return view('magzine.advaisoryboard.index',compact('advaisoryboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('magzine.advaisoryboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvaisoryBoardRequest $request)
    {

       $advaisoryboard = new AdvaisoryBoard();   
       if($request->file('image')){
            $path = public_path('advisoryboard').'/';
            $imageName = preg_replace('/\s+/','-',time().'-advaisoryboard-'.$request->file('image')->getClientOriginalName());
            request()->image->move($path, $imageName);
            $advaisoryboard->image = $imageName;  
        }


        $advaisoryboard->title = $request->title;
        $advaisoryboard->title_tag = $request->title_tag;
        $advaisoryboard->alt_tag = $request->alt_tag;
        $advaisoryboard->description = $request->description;
        $advaisoryboard->home_description = $request->home_description;
        $advaisoryboard->home_flag = $request->home_flag;
        $advaisoryboard->active_flag = $request->active_flag;
        $advaisoryboard->created_by = \Auth::id();
        $advaisoryboard->save();

        return redirect()->route('advisorboard.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdvaisoryBoard  $advaisoryBoard
     * @return \Illuminate\Http\Response
     */
    public function show(AdvaisoryBoard $advisorboard)
    {

      return view('magzine.advaisoryboard.show',compact('advisorboard'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdvaisoryBoard  $advaisoryBoard
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvaisoryBoard $advisorboard)
    {

        return view('magzine.advaisoryboard.edit',compact('advisorboard'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdvaisoryBoard  $advaisoryBoard
     * @return \Illuminate\Http\Response
     */
    public function update(AdvaisoryBoardRequest $request, AdvaisoryBoard $advisorboard)
    {
     
        $path = public_path('advisoryboard').'/';
        if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-advisoryboard-'.$request->file('image')->getClientOriginalName());
            if(request()->image->move($path, $imageName)){                  
                if(File::exists($path.$advisorboard->image)){                  
                    \File::delete($path.$advisorboard->image);                         
                }
                $advisorboard->image = $imageName;
            }
        }       

         $advisorboard->update($request->except('image'));
               
         $advisorboard->modified_by = \Auth::id();
         
         if($advisorboard->save())  {          
            return redirect()->route('advisorboard.index');
         }  
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdvaisoryBoard  $advaisoryBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvaisoryBoard $advisorboard)
    {
        
         $advisorboard->active_flag = 0;
         $advisorboard->save();
         Session::flash('message_type', 'danger');
         Session::flash('message_icon', 'checkmark');
         Session::flash('message_header', 'Success');
         Session::flash('message', 'AdvaisoryBoard '.$advisorboard->title.' deactiveted !');
         return redirect()->route('advisorboard.index');
    }

    public function reactivate(AdvaisoryBoard $advisorboard)
    {        

      $advisorboard->active_flag = 1;
      $advisorboard->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'AdvaisoryBoard '.$advisorboard->title.' Activeted !');
       return redirect()->route('advisorboard.index');
    }

     public function metatag(Request $request,$advisorboard)
    {


        $meta = AdvaisoryBoard::findOrFail($advisorboard);
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
        Session::flash('message', 'The AdvaisoryBoard ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
