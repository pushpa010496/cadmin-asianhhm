<?php

namespace App\Http\Controllers;

use App\Editorialarticle;
use Illuminate\Http\Request;
use App\Category;
use App\Issue;
use File;
use Session;
use App\Contributors;
use App\Http\Requests\EditorialArticleRequest;


class EditorialarticleController extends Controller
{
     public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->get('search')){
            $search = \Request::get('search');
            $data = Editorialarticle::whereHas('issue' , function($query) use($search) {
                $query->where('issue_no', 'like', '%'.$search.'%');})
            ->orwhere('title', 'like', '%'.$search.'%')
            ->paginate(20);
            $data->appends(['search' => $search]);

        }


             
        //  if($request->get('search')){
        // // $search = \Request::get('search'); 
        // // $data = Editorialarticle::where('title', 'like', '%'.$search.'%')->paginate(20);
        //    $search = \Request::get('search');
        //    // $data = Editorialarticle::whereHas('issue' , function($query) use($search) {
        //    //  $query->where('issue_no', 'like', '%'.$search.'%');})
        //    // ->where('title', 'like', '%'.$search.'%')
        //    // ->paginate(20);

        //    $data = Editorialarticle::whereHas('issue', function ($query) use ($search){
        //     $query->where('issue_no', 'like', '%'.$search.'%');
        //     })
        //    ->where('title', 'like', '%'.$search.'%')
        //    ->with(['issue' => function($query) use ($search){
        //     $query->where('title', 'like', '%'.$search.'%');
        //     }])
        //    ->orderBy('id', 'desc')->paginate(30);

        //  }
        else{
            $data = Editorialarticle::orderBy('id', 'desc')->paginate(10);
           
         }
       

        //$data = Editorialarticle::paginate(10);
        return view('editorial.article.index',compact('data'));
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
        $author = Contributors::select(
            \DB::raw("CONCAT(title,' --- ',DATE_FORMAT(created_at, '%d/%m/%Y')) AS title"),'id')->
        where(['active_flag'=>1,'type'=>1])->orderBy('id','desc')->pluck('title','id')->prepend('-- select author --','');
        return view('editorial.article.create',compact('categories','issues','author'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditorialArticleRequest $request)
    {
     
        $article = new Editorialarticle($request->except('image','url'));   
        if($request->file('image')){
        $imageName = preg_replace('/\s+/','-',time().'-article-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('editorialarticle'), $imageName);
        $article->image = $imageName;  
        }
       
        $article->url = str_slug($request->url);          
        $article->author_id = implode(',', $request->author_id);
        $article->created_by = \Auth::id();
        $article->save();
        if($request->author_id[0] != ''){
            $article->authors()->attach($request->author_id);
        }
        return redirect()->route('editorialarticle.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Editorialarticle $editorialarticle)
    {
      
        return view('editorial.article.show',compact('editorialarticle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Editorialarticle $editorialarticle)
    {
       $categories = Category::where('active_flag',1)->pluck('name','id')->prepend('-- select category --','');
       $issues =Issue::where('active_flag',1)->pluck('issue_no','id')->prepend('-- Select issue --','');
        // $author=Contributors::where(['active_flag'=>1,'type'=>1])->pluck('title','id')->prepend('-- select author --','');
       $author = Contributors::select(
        \DB::raw("CONCAT(title,' --- ',DATE_FORMAT(created_at, '%d/%m/%Y')) AS title"),'id')->
       where(['active_flag'=>1,'type'=>1])->orderBy('id','desc')->pluck('title','id')->prepend('-- select author --','');
       
    //   dd($author);
       return view('editorial.article.edit',compact('categories','issues','editorialarticle','author'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditorialArticleRequest $request, Editorialarticle $editorialarticle)
    {
       
        $path = public_path('editorialarticle').'/';
        if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-article-'.$request->file('image')->getClientOriginalName());
            if(request()->image->move($path, $imageName)){     

                if(File::exists($path.$editorialarticle->image)){  

                    \File::delete($path.$editorialarticle->image);                         
                }
                $editorialarticle->image = $imageName;
            }
        }
   

         $editorialarticle->url = str_slug($request->url);                   
         $editorialarticle->update($request->except('image','url','author_id'));
         $editorialarticle->modified_by = \Auth::id();
         if($editorialarticle->save())  {
            $editorialarticle->authors()->sync($request->author_id);       
            return redirect()->route('editorialarticle.index');
         }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function destroy(Editorialarticle $editorialarticle)
    {
        $editorialarticle->active_flag = 0;
        $editorialarticle->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Editorial Article '.$editorialarticle->title.' deactiveted !');
         return redirect()->route('editorialarticle.index');
    }

    public function reactivate(Editorialarticle $editorialarticle)
    {        

      $editorialarticle->active_flag = 1;
      $editorialarticle->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Editorial Article '.$editorialarticle->title.' Activeted !');
       return redirect()->route('editorialarticle.index');
    }

      public function metatag(Request $request,$id)
    {
        $meta = Editorialarticle::findOrFail($id);
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
        Session::flash('message', 'The Editorial Article ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
