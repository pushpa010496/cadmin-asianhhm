<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use App\User;
use Auth;
use App\Page;
use App\Position;
use App\Tracklink;
use App\Slider;
use Illuminate\Http\Request;
use \Session;
use App\Banner;

class BannerController extends Controller
{
	protected $model;

	public function __construct(Banner $model)
	{
		$this->model = $model;
		$this->middleware('auth');
	}

	 public function index(Request $request)
    {
       $search = \Request::get('search');
         $banner_search = \Request::get('banner_search'); 
         $sliders = Banner::when(!empty($search), function ($query) use ($search) {
                return $query->where('title', 'like', '%'.$search.'%');
            })
            ->when(!empty($banner_search), function ($query) use ($banner_search) {
                return $query->where('active_flag', $banner_search);
            })
            ->orderBy('id','desc')
            ->paginate(20);
		return view('banners.index', compact('sliders'));
    }

	public function create()
	{
		$pages = Page::where('active_flag',1)->where('parent_id',0)->pluck('title','id');
		$position = Position::where('active_flag','1')->pluck('position','id');
		$category = Page::where('active_flag',1)->where('parent_id',3)->pluck('title','id');
	    return view('banners.create',compact('pages','position','category'));
	}
	public function store(Request $request)
	{

		$banner = new Banner();

		request()->validate([
			'title' => 'required|max:255',
            'image' => 'required',
            'url'	=>	'required'
        ]);

		if($request->url !=""){			
            // create short link
			$tracklinks = new Tracklink();
			$tracklinks->setConnection('mysql2');
			$tracklinks->type =  "ban";
			$tracklinks->title =  $request->title;
			$tracklinks->oriurl =  $request->url;
			$tracklinks->shorturl_id =  date('Ymdhis').rand();
			$tracklinks->titleid =  rand();
			$tracklinks->save();

			$track_url = 'http://track.asianhhm.com/'.$tracklinks->shorturl_id. '/';	

			$banner->url = $track_url;
            //end short link
		}else{
			$banner->url = $request->url;
		}
		
		
		if($request->file('image')){
        $imageName = preg_replace('/\s+/','-',time().'-'.$request->file('image')->getClientOriginalName());


        request()->image->move(public_path('ensign'), $imageName);
		$banner->image = $imageName;	
	    }
	    $data = [
          	'name' => ucfirst($request->input("title")),
		   	'from_date' => $request->input("from_date"),
		   	'to_date' => $request->input("to_date"),
		   	'track_url'=>$track_url,
		   	'type'=>$request->input("position"),
		   	'status'=>$request->active_flag == 1 ? 'Active' : 'In-Active'
        ];

	    $emails = explode(',', $request->emails);
	    $title = ucfirst($request->title);
			foreach($emails as $email){ 

			    Mail::send('emails.banner.admin', $data, function($message) use ($data,$email,$title) {
		        $message->to($email);   
		        $message->subject($title.'-'.'Asianhhm!');
		        });	
		}
	   	$banner->title = ucfirst($request->input("title"));
	   	$banner->from_date = $request->input("from_date");
	   	$banner->to_date = $request->input("to_date");
		$banner->img_title = $request->input("img_title");
		$banner->img_alt = $request->input("img_alt");
		$banner->anchor_title = $request->input("anchor_title");
		// $banner->url = $request->input("url");
		$banner->type = $request->input("type");
		$banner->script = $request->input("script");
		$banner->script = $request->input("script");
		//$banner->position = $request->input("position");
		
		$banner->active_flag = $request->input("active_flag");
		$banner->author_id = $request->user()->id;
        $banner->save();
        
       $banner->pages()->attach($request->input("pages"));
       if($request->category[0] != ''){
			$banner->pages()->attach($request->input("category"));
        }
       $banner->positions()->attach($request->input("position"));


		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The banner \"<a href='ensign/$banner->title'>" . $banner->name . "</a>\" was Created.");

		return redirect()->route('banners.index');
	}

	public function show(Banner $banner)
	{
		
		//$slider = $this->model->findOrFail($id);

		return view('banners.show', compact('banner'));
	}
	public function edit(Banner $banner)
	{
		//print_r($slider->positions()->pluck('id'));die;
		
		$pages = Page::where('active_flag',1)->where('parent_id',0)->pluck('title','id');
		$position = Position::where('active_flag','1')->pluck('position','id');
		$category = Page::where('active_flag',1)->where('parent_id',3)->pluck('title','id');
		return view('banners.edit', compact('banner','pages','position','category'));
	}

	public function update(Request $request, banner $banner, User $user)
	{
		request()->validate([
			'title' => 'required|max:255',
          
           
        ]);
		
		if($request->file('image')){
        $imageName = preg_replace('/\s+/','-',time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('ensign'), $imageName);
		$banner->image = $imageName;	
	    }
	    $data = [
          	'name' => ucfirst($request->input("title")),
		   	'from_date' => $request->input("from_date"),
		   	'to_date' => $request->input("to_date"),
		   	'track_url'=>$banner->url,
		   	'type'=>$request->input("position"),
		   	'status'=>$request->active_flag == 1 ? 'Active' : 'In-Active'
        ];

	    $emails = explode(',', $request->emails);
	    $title = ucfirst($request->title);
			foreach($emails as $email){
			    Mail::send('emails.banner.admin', $data, function($message) use ($data,$email,$title) {
		        $message->to($email);   
		        $message->subject($title.'-'.'Asianhhm!');
		        });	
		}
	   	$banner->from_date = $request->input("from_date");
	   	$banner->to_date = $request->input("to_date");
		$banner->title = ucfirst($request->input("title"));
		$banner->img_title = $request->input("img_title");
		$banner->img_alt = $request->input("img_alt");
		$banner->anchor_title = $request->input("anchor_title");
		$banner->url = $request->input("url");
		$banner->type = $request->input("type");
		$banner->script = $request->input("script");
		
		$banner->active_flag = $request->input("active_flag");
		$banner->author_id = $request->user()->id;
        $banner->save();
       	$banner->pages()->sync($request->input("pages"));
       	$banner->positions()->sync($request->input("position"));
		if($request->category[0] != ''){
			$banner->pages()->attach($request->input("category"));
        }
		$banner->save();

		Session::flash('message_type', 'warning');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The banner \"<a href='ensign/$banner->title'>" . $banner->name . "</a>\" was Updated.");

		return redirect()->route('banners.index');
	}
	public function destroy(Banner $banner)
	{

		$banner->active_flag = 0;
		$banner->save();

		Session::flash('message_type', 'danger');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The banner ' . $banner->name . ' was De-Activated.');

		return redirect()->route('banners.index');
	}

	public function reactivate($id)
	{

		$banner = Banner::findOrFail($id);
		$banner->active_flag = 1;
		$banner->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The banner ' . $banner->name . ' was Re-Activated.');

		return redirect()->route('banners.index');
	}

	public function bannersactive(){

		$banners = Banner::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);

		return view('banners.active_banners',compact('banners'));
	}
	
}