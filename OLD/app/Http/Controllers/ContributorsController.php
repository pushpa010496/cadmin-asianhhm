<?php

namespace App\Http\Controllers;

use App\Contributors;
use Illuminate\Http\Request;
use App\Http\Requests\ContributorsRequest;
use App\Category;
use App\Issue;
use App\Editorialarticle;
use File;
use Session;
class ContributorsController extends Controller
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
        $data = Contributors::where('title', 'like', '%'.$search.'%')->paginate(50);
         }else{
            $data = Contributors::orderBy('id', 'desc')->paginate(100);
         }
        $active = Contributors::where('active_flag', 1);
        // $data = Contributors::paginate(10);
        return view('editorial.contributors.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::where('active_flag',1)->pluck('name','id')->prepend('-- select category --','');
        $issues =Issue::where('active_flag',1)->pluck('issue_no','id')->prepend('-- Select issue --','');
        $articles =Editorialarticle::where('active_flag',1)->pluck('title','id')->prepend('-- Select Article --','');
        return view('editorial.contributors.create',compact('categories','issues','articles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContributorsRequest $request)
    {
   

        $contributors = new Contributors($request->except('image','url'));  

        if($request->file('image')){

        $imageName = preg_replace('/\s+/','-',time().'-contributor-'.$request->file('image')->getClientOriginalName());

       
        request()->image->move(public_path('contributors'), $imageName);
        $contributors->image = $imageName;  
        }       
        $contributors->url = str_slug($request->url);
        //$contributors->author_id = \Auth::id();        
        $contributors->save();
        return redirect()->route('contributors.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contributors  $contributors
     * @return \Illuminate\Http\Response
     */
    public function show(Contributors $contributor)
    {
        
        return view('editorial.contributors.show',compact('contributor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contributors  $contributors
     * @return \Illuminate\Http\Response
     */
    public function edit(Contributors $contributor)
    {
        $categories = Category::where('active_flag',1)->pluck('name','id')->prepend('-- select category --','');
        $issues =Issue::where('active_flag',1)->pluck('issue_no','id')->prepend('-- Select issue --','');
        $articles =Editorialarticle::where('active_flag',1)->pluck('title','id')->prepend('-- Select Article --','');
        return view('editorial.contributors.edit',compact('categories','issues','articles','contributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contributors  $contributors
     * @return \Illuminate\Http\Response
     */
    public function update(ContributorsRequest $request, Contributors $contributor)
    {
        $path = public_path('contributors').'/';
        if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-article-'.$request->file('image')->getClientOriginalName());
            if(request()->image->move($path, $imageName)){     
                if(File::exists($path.$contributor->image)){  
                    \File::delete($path.$contributor->image);                         
                }
                $contributor->image = $imageName;
            }   
        }
   
         $contributor->url = str_slug($request->url);  
         //$contributor->author_id = \Auth::id();                 
         $contributor->update($request->except('image','url'));
         if($contributor->save())  {          
            return redirect()->route('contributors.index');
         }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contributors  $contributors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contributors $contributor)
   {
        $contributor->active_flag = 0;
        $contributor->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'contributor '.$contributor->title.' deactiveted !');
         return redirect()->route('contributors.index');
    }

    public function reactivate(Contributors $contributor)
    {        

      $contributor->active_flag = 1;
      $contributor->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'contributor '.$contributor->title.' Activeted !');
       return redirect()->route('contributors.index');
    }
}
