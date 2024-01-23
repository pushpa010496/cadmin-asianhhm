<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Contributors;
use Session;
class ArticleController extends Controller
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
        $article = Article::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $article = Article::orderBy('id', 'desc')->paginate(10);
         }
        $active = Article::where('active_flag', 1);

        return view('knowledgebank.article.index',compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $author=Contributors::where('active_flag',1)->where('type',2)->pluck('title','id')->prepend('-- select author --','');
        
      return view('knowledgebank.article.create',compact('author'));
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
            'title' => 'required|unique:articles',
            'url'   =>'required',
            'author_id'   =>'required',
            'short_description'=>'required',
            'home_short_description'=>'required',
            'main_body'=>'required',
            'active_flag'=>'required'
        ]);
        $article = new Article($request->except(['created_by','url','author_id']));
        // if($request->file('author_image')){
        //     $filename = time().'-'.$request->file('author_image')->getClientOriginalName();
        //     request()->author_image->move(public_path('knowledgebank/article'),$filename);
        //     $article->author_image = $filename;
        // }
        if($request->file('image')){
            $filename = time().'-'.$request->file('image')->getClientOriginalName();
            request()->image->move(public_path('knowledgebank/article'),$filename);
            $article->image = $filename;
        }
        $article->url = str_slug($request->url);
        $article->created_by = Auth::user()->id;
        $article->meta_title = $request->title;
        $article->meta_description = $request->short_description;
        $article->save();

        if($request->author_id[0] != ''){

            $article->authors()->attach($request->author_id);

        }
       return redirect()->route('article.index')->with(['create_message'=>'successfully Craeted','alert'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
     
     return view('knowledgebank.article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // $author=Contributors::where('active_flag',1)->where('type',2)->pluck('title','id')->prepend('-- select author --','');

      $author = Contributors::select(
            \DB::raw("CONCAT(title,' --- ',DATE_FORMAT(created_at, '%d/%l/%Y')) AS title"),'id')->
            where(['active_flag'=>1,'type'=>2])->orderBy('id','desc')->pluck('title','id')->prepend('-- select author --','');
       return view('knowledgebank.article.edit',compact('article','author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
      request()->validate([
       'title' => 'required',
       'url'   =>'required',
       'author_id'   =>'required',
       'short_description'=>'required',
       'home_short_description'=>'required',
       'main_body'=>'required',
       'active_flag'=>'required'
    ]);
       
        // if($request->file('author_image')){
        //     $filename = time().'-'.$request->file('author_image')->getClientOriginalName();
        //     request()->author_image->move(public_path('knowledgebank/article'),$filename);
        //     $article->author_image = $filename;
        // }
      $article->url = str_slug($request->url);
      $article->updated_by = Auth::user()->id;
      $article->update($request->except(['updated_by','url','author_id']));
      $article->meta_title = $request->title;
      $article->meta_description = $request->short_description;
      $article->save();
      $article->authors()->sync($request->author_id);       

        return redirect()->route('article.index')->with(['create_message'=>'successfully Updated','alert'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->active_flag = 0;
        $article->save();

        return redirect()->back()->with(['create_message'=>'successfully Deactivted','alert'=>'danger']);
    }

    public function reactivate($id)
    {

        $article = Article::findOrFail($id);
        $article->active_flag = 1;
        $article->save();

        return redirect()->back()->with(['create_message', 'The Article ' . $article->name . ' was Re-Activated.','alert'=>'success']);
    
    }

    //  public function test()
    // {
    //      $article = Article::all();        
    //      foreach($article as $val){
    //         $tbl = \DB::table('tbl_articles')->where('article_url',$val->url)->get()->take(1);
                         
    //                     // $val->abstract = $tbl[0]->abstract;
    //         if($val->abstract != ''){
                
    //             $val->short_description = $val->abstract;
               
    //         }else{

    //             $val->short_description = str_limit(preg_replace('/[^a-zA-Z\s]/', '', strip_tags(html_entity_decode(ucfirst($val->main_body)))),$limit = 310,$end='');
    //         }
    //          $val->save();
    //      }
       
    //     return 'done';
    
    // }

      public function metatag(Request $request,$article)
    {


        $meta = Article::findOrFail($article);
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
        Session::flash('message', 'The Article ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
