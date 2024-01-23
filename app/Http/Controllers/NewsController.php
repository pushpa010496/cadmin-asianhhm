<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use \Session;
use Illuminate\Support\Str;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       
       	if($request->get('search'))
       	{
    		$search = \Request::get('search'); 
     		$news = News::select('id','date','title')->where('title', 'like', '%'.$search.'%')->paginate(10);
   		 }
   		 else
   		 {
   			$news = News::select('id','date','title')->orderBy('id', 'desc')->paginate(10);
		 }
		$active = News::select('id','date','title')->where('active_flag', 1);
		return view('news.index', compact('news','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
         return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $news = new News();

        request()->validate([
            'title' => 'required|max:255',
            'url'   =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'home_description'=>'required',
             'home_title' => 'required|max:255',
             
            
        ]);
        
        if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('news'), $imageName);
        $news->news_image = $imageName;  
        }     
        if($request->file('big_image')){
            $big_imageName = preg_replace('/\s+/', '-', time().'-big-'.$request->file('big_image')->getClientOriginalName());
            request()->big_image->move(public_path('news'), $big_imageName);
            $news->big_image = $big_imageName;  
            }   
        $news->date = ucfirst($request->input("date"));
        $news->title = ucfirst($request->input("title"));
        $news->display_img_home = ucfirst($request->input("display"));
        $news->img_title = ucfirst($request->input("img_title"));
        $news->news_img_alt = ucfirst($request->input("news_img_alt"));
        $news->location = ucfirst($request->input("location"));
        $news->url = Str::slug($request->input("url"), "-");
        $news->home_title = ucfirst($request->input("home_title"));
        $news->home_description = ucfirst($request->input("home_description"));
         $news->short_description = ucfirst($request->input("home_description"));
        $news->description = ucfirst($request->input("description"));       
        $news->active_flag = $request->input("active_flag");
         $news->created_by = $request->user()->id;
        $news->meta_title = $request->title;
        $news->meta_description = $request->home_description;
       // $news->author_id = '1';
        $news->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The news " . $news->name . " was Created.");

        return redirect()->route('newsone.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $newsone)
    {
        return view('news.show', compact('newsone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $newsone)
    {
       
     return view('news.edit',compact('newsone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $newsone)
    {   

        request()->validate([
            'title' => 'required|max:255',
             'url'   =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'home_description'=>'required',
             'home_title' => 'required|max:255',
            
        ]);
        
        if($request->file('image')){
            $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
            request()->image->move(public_path('news'), $imageName);
            $newsone->news_image = $imageName;  
            }     
            if($request->file('big_image')){
                $big_imageName = preg_replace('/\s+/', '-', time().'-big-'.$request->file('big_image')->getClientOriginalName());
                request()->big_image->move(public_path('news'), $big_imageName);
                $newsone->big_image = $big_imageName;  
                } 
        
        $newsone->date = ucfirst($request->input("date"));
        $newsone->title = ucfirst($request->input("title"));
        $newsone->display_img_home = ucfirst($request->input("display"));
        $newsone->img_title = ucfirst($request->input("img_title"));
        $newsone->news_img_alt = ucfirst($request->input("news_img_alt"));
        $newsone->location = ucfirst($request->input("location"));
        $newsone->url = Str::slug($request->input("url"), "-");
        $newsone->home_title = ucfirst($request->input("home_title"));
        $newsone->home_description = ucfirst($request->input("home_description"));
        $newsone->short_description = ucfirst($request->input("home_description"));
        $newsone->description = ucfirst($request->input("description"));       
        $newsone->active_flag = $request->input("active_flag");
        $newsone->updated_by = $request->user()->id;
        $newsone->meta_title = ucfirst($request->input("title"));
        $newsone->meta_description = ucfirst($request->input("home_description"));

        $newsone->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The news " . $newsone->name . " was Updated.");

        return redirect()->route('newsone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
       
        $news->active_flag = 0;
        $news->save();

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The news ' . $news->name . ' was De-Activated.');

        return redirect()->route('news.index');
    }
        public function reactivate(News $news,$id)
    {

        $news = News::findOrFail($id);
        $news->active_flag = 1;
        $news->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The news ' . $news->name . ' was Re-Activated.');

        return redirect()->route('news.index');
    }
    public function metatag(Request $request,$id)
    {
        $meta = News::findOrFail($id);
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
        Session::flash('message', 'The News ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
