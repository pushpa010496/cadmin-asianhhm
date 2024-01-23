<?php

namespace App\Http\Controllers;

use App\Online;
use Illuminate\Http\Request;
use File;
class OnlineController extends Controller
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
        $online = Online::where('title', 'like', '%'.$search.'%')->paginate(20);

        
         }else{
            $online = Online::orderBy('id', 'desc')->paginate(10);
             
         }
        $active = Online::where('active_flag', 1);
       return view('online.index',compact('online'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('online.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       request()->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);
        
       $online = new Online($request->except(['image','author_id']));
       if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('online'), $imageName);
        $online->image = $imageName;  
        }
        $online->author_id = \Auth::user()->id;  
       $online->save();

       return redirect()->route('online.index')->with(['create_message'=>'successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Online  $online
     * @return \Illuminate\Http\Response
     */
    public function show(Online $online)
    {
      return view('online.show',compact('online'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Online  $online
     * @return \Illuminate\Http\Response
     */
    public function edit(Online $online)
    {
     return view('online.edit',compact('online'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Online  $online
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Online $online)
    {
       request()->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);
       
     
        $image_name = public_path('online')."/".$online->image;
      

      if(File::exists($image_name)){
        if($request->file('image')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('online'),$imagename);
        $online->image = $imagename;
        }
        else{
           $online->image = $online->image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('online'),$imagename);
        $online->image = $imagename;
        }
         
        $online->title = ucfirst($request->input("title"));
        $online->sub_title = ucfirst($request->input("sub_title"));
        $online->title_tag = ucfirst($request->input("title_tag"));
        $online->alt_tag = ucfirst($request->input("alt_tag"));
        $online->description = ucfirst($request->input("description"));
        $online->active_flag = $request->input("active_flag");
        $online->author_id = $request->user()->id;
        $online->save();
       return redirect()->route('online.index')->with(['create_message'=>'successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Online  $online
     * @return \Illuminate\Http\Response
     */
    public function destroy(Online $online)
    {
       $online->active_flag = 0;
        $online->save();

        
       

        return redirect()->route('online.index')->with('create_message', 'The online ' . $online->name . ' was De-Activated.');
    }

    public function reactivate($id)
    {

        $online = Online::findOrFail($id);
        $online->active_flag = 1;
        $online->save();

        return redirect()->route('online.index')->with('create_message', 'The online ' . $online->name . ' was Re-Activated.');
    }
}
