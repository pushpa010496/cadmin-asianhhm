<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use File;
class TermController extends Controller
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
        $terms = Term::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $terms = Term::orderBy('id', 'desc')->paginate(10);
         }
        $active = Term::where('active_flag', 1);

        return view('terms.index',compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('terms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       request()->validate(['title' =>'required|unique:target_markets',
       'image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
       'term_url'=>'required',
       'sub_title'=>'required',
       'title_tag'=>'required',
       'description'=>'required',
       'alt_tag'=>'required'
      
   ]);

      $terms = new Term($request->except(['image','pdf','author_id','term_url']));
      if($request->file('image')){
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('terms'),$imagename);
        $terms->image = $imagename;

    }
    
    $terms->author_id = Auth::user()->id;
    $terms->term_url = Str::slug($request->term_url);
    $terms->save();

    return redirect()->route('terms.index')->with(['create_message'=>'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        $terms = $term;
       return view('terms.show',compact('terms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        $terms = $term;
       return view('terms.edit',compact('terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        request()->validate
      (['title' =>'required|unique:target_markets',
       'image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'term_url'=>'required',
       'sub_title'=>'required',
       'title_tag'=>'required',
       'description'=>'required',
       'alt_tag'=>'required'
       
   ]);

      $terms = $term;
      $term_image_name = $term->image;
      $image_name = public_path('terms')."/".$term->image;
      

      if(File::exists($image_name)){
        if($request->file('image')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('terms'),$imagename);
        $terms->image = $imagename;
        }
        else{
           $terms->image = $terms->image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('terms'),$imagename);
        $terms->image = $imagename;
        }
   

    $terms->author_id = Auth::user()->id;
    $terms->term_url = Str::slug($request->term_url);
    $terms->update($request->except(['image','pdf','author_id','term_url']));
    $terms->save();
       return redirect()->route('terms.index')->with(['create_message'=>'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        $term->active_flag = 0;
       $term->save();

       return redirect()->route('terms.index')->with(['create_message'=>'Success fully deactivated']);
    }

    public function reactivate($id)
    {

        $terms = Term::findOrFail($id);
        $terms->active_flag = 1;
        $terms->save();

        return redirect()->route('terms.index')->with('create_message', 'The terms ' . $terms->name . ' was Re-Activated.');
    
    }
}
