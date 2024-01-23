<?php

namespace App\Http\Controllers;

use App\Advertiser;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use File;
class AdvertiserController extends Controller
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
        $advertisers = Advertiser::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $advertisers = Advertiser::orderBy('id', 'desc')->paginate(10);
         }
        $active = Advertiser::where('active_flag', 1);

        return view('advertisers.index',compact('advertisers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('active_flag',1)->pluck('name','id')->prepend('Select Category');
       return view('advertisers.create',compact('category'));
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
            'title'=>'required|unique:advertisers',
            'image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'=>'required'
              ]);

        $advertiser = new Advertiser($request->except('author_id','image'));
        if($request->file('image')){
            $imagename = time().'-'.$request->file('image')->getClientOriginalName();
            request()->image->move(public_path('advertisers'),$imagename);
            $advertiser->image = $imagename;
        }
        $advertiser->author_id = Auth::user()->id;

        $advertiser->save();

        return redirect()->route('advertisers.index')->with(['create_message' => 'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function show(Advertiser $advertiser)
    {
      return view('advertisers.show',compact('advertiser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertiser $advertiser)
    {
        $category = Category::where('active_flag',1)->pluck('name','id')->prepend('Select Category');
        return view('advertisers.edit',compact('advertiser','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertiser $advertiser)
    {

       request()->validate(['title'=>'required',
                        //'image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'category_id'=>'required']);
  
   $image_name = public_path('advertisers')."/".$advertiser->image;
       

      if(File::exists($image_name)){
        if($request->file('image')){
           File::delete($image_name);
           $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
           request()->image->move(public_path('advertisers'),$imagename);
           $advertiser->image = $imagename;
       }
        else{
           $advertiser->image = $advertiser->image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('advertisers'),$imagename);
        $advertiser->image = $imagename;
        }

       $advertiser->author_id = Auth::user()->id;
        $advertiser->update($request->except('author_id','image'));
       $advertiser->save();

       return redirect()->route('advertisers.index')->with(['create_message' => 'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertiser $advertiser)
    {
       $advertiser->active_flag = 0;
       $advertiser->save();
       return redirect()->back()->with(['create_message'=>'The Advertiser ' . $advertiser->title . ' was Deactivated.','alert'=>'danger']);
    }
    public function reactivate($id)
    {

        $advertiser = Advertiser::findOrFail($id);
        $advertiser->active_flag = 1;
        $advertiser->save();

        return redirect()->back()->with(['create_message'=>'The Advertiser ' . $advertiser->title . ' was Re-Activated.','alert'=>'success']);
    
    }
}
