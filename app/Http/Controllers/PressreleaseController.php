<?php

namespace App\Http\Controllers;

use App\Models\Pressrelease;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use \Session;
class PressreleaseController extends Controller
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
        $pressreleases = Pressrelease::select('id','date','title','url')->where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $pressreleases = Pressrelease::select('id','date','title','url')->orderBy('id', 'desc')->paginate(10);
         }
        $active = Pressrelease::select('id','date','title','url')->where('active_flag', 1);
        return view('pressreleases.index', compact('pressreleases', 'active'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pressreleases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $pressreleases = new Pressrelease();

        request()->validate([
            'title' => 'required|max:255',
           'url'  =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'short_description'=>'required',
          
        ]);
        
        if($request->file('image')){
            $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
            request()->image->move(public_path('pressreleases'), $imageName);
            $pressreleases->image = $imageName; 
            }       
       
        if($request->file('big_image')){
            $big_imageName = preg_replace('/\s+/', '-', time().'-big-'.$request->file('big_image')->getClientOriginalName());
            request()->big_image->move(public_path('pressreleases'), $big_imageName);
            $pressreleases->big_image = $big_imageName; 
            }  
        $pressreleases->date = ucfirst($request->input("date"));
        $pressreleases->title = ucfirst($request->input("title"));
        $pressreleases->display_img_home = ucfirst($request->input("display"));
        $pressreleases->img_title = ucfirst($request->input("img_title"));
        $pressreleases->img_alt = ucfirst($request->input("img_alt"));
        $pressreleases->location = ucfirst($request->input("location"));
        $pressreleases->url = Str::slug($request->input("url"), "-");
        $pressreleases->home_title = ucfirst($request->input("home_title"));
        $pressreleases->short_description = ucfirst($request->input("short_description"));
        $pressreleases->home_description = ucfirst($request->input("short_description"));
        $pressreleases->description = ucfirst($request->input("description"));      
        $pressreleases->active_flag = $request->input("active_flag");
        $pressreleases->created_by = \Auth::user()->id;
        $pressreleases->issuer = 'Ochre';
        //$pressreleases->author_id = '1';
        $pressreleases->meta_title = ucfirst($request->input("title"));
        $pressreleases->meta_description = ucfirst($request->input("short_description"));
        $pressreleases->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The pressreleases " . $pressreleases->name . " was Created.");

        return redirect()->route('pressrelease.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function show(Pressrelease $pressrelease)
    {
        return view('pressreleases.show', compact('pressrelease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function edit(Pressrelease $pressrelease)
    {
        return view('pressreleases.edit', compact('pressrelease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pressrelease $pressrelease)
    {

       request()->validate([
            'title' => 'required|max:255',
             'url'  =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'short_description'=>'required'
        ]);
        
        if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('pressreleases'), $imageName);
        $pressrelease->image = $imageName;  
       // dd($imageName1 = request()->image->move(public_path('pressreleases'), $imageName));
        }
        if($request->file('big_image')){
            $big_imageName = preg_replace('/\s+/', '-', time().'-big-'.$request->file('big_image')->getClientOriginalName());
            request()->big_image->move(public_path('pressreleases'), $big_imageName);
            $pressrelease->big_image = $big_imageName; 
            
            } 

           
    
        $pressrelease->date = ucfirst($request->input("date"));
        $pressrelease->title = ucfirst($request->input("title"));
        $pressrelease->display_img_home = ucfirst($request->input("display"));
        $pressrelease->img_title = ucfirst($request->input("img_title"));
        $pressrelease->img_alt = ucfirst($request->input("img_alt"));
        $pressrelease->location = ucfirst($request->input("location"));
        $pressrelease->url = Str::slug($request->input("url"), "-");
        $pressrelease->home_title = ucfirst($request->input("home_title"));
        $pressrelease->short_description = ucfirst($request->input("short_description"));
        $pressrelease->home_description = ucfirst($request->input("short_description"));
        $pressrelease->description = ucfirst($request->input("description"));       
        $pressrelease->active_flag = $request->input("active_flag");
         $pressrelease->updated_by = \Auth::user()->id;
        //$pressrelease->author_id ='1';
        $pressrelease->meta_title = ucfirst($request->input("title"));
        $pressrelease->meta_description = ucfirst($request->input("short_description"));
        
        $pressrelease->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The pressreleases " . $pressrelease->title . " was Updated.");

        return redirect()->route('pressrelease.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pressrelease $pressrelease)
    {
       $pressrelease->active_flag = 0;
        $pressrelease->save();

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The pressreleases ' . $pressrelease->title . ' was De-Activated.');

        return redirect()->route('pressrelease.index');
    }

    public function reactivate(Pressrelease $pressrelease,$id)
    {

        $pressrelease = Pressrelease::findOrFail($id);
        $pressrelease->active_flag = 1;
        $pressrelease->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The pressreleases ' . $pressrelease->title . ' was Re-Activated.');

        return redirect()->route('pressrelease.index');
    }
    public function metatag(Request $request,$id)
    {

        $meta = Pressrelease::findOrFail($id);
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
        Session::flash('message', 'The Pressreleases ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}