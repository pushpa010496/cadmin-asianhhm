<?php

namespace App\Http\Controllers;

use App\Ebook;
use App\Issue;
use File;
use Illuminate\Http\Request;
use Session;
class EbookController extends Controller
{
    protected $model;

    /**
     * Create instance of controller with Model
     *
     * @return void
     */
    public function __construct(Ebook $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index()
    {

       $ebook=Ebook::orderBy('id', 'desc')->paginate(10);
       
       return view('magzine.ebook.index',compact('ebook'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $issues =  Issue::pluck('issue_no','id')->prepend('-- select Issue --','');
        return view('magzine.ebook.create',compact('issues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       request()->validate(['title' =>'required|unique:ebooks',
        'ebook_image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'magazine_image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_sm' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'url' =>'required',
        'topic_1'=>'required',
        'ebook_script'=>'required',
        'issue_id'=>'required'

    ]);
        $ebook = new Ebook($request->except('ebook_image','magazine_image','url'));   
        $issue = Issue::find($request->issue_id);
        if($request->file('ebook_image')){
            $ebook_imageName = preg_replace('/\s+/','-',time().'-ebook-'.$request->file('ebook_image')->getClientOriginalName());
            request()->ebook_image->move(public_path().'ebooks/'.str_slug($issue->issue_no).'/', $ebook_imageName);
            $ebook->ebook_image = $ebook_imageName;  
        }

        if($request->file('magazine_image')){
            $magazine_imageName = preg_replace('/\s+/','-',time().'-ebook-'.$request->file('magazine_image')->getClientOriginalName());
            request()->magazine_image->move(public_path('ebooks').'/'.str_slug($issue->issue_no).'/', $magazine_imageName);
            $ebook->magazine_image = $magazine_imageName;  
        }

         if($request->file('image_md')){
            $image_mdName = preg_replace('/\s+/','-',time().'-ebook-md-'.$request->file('image_md')->getClientOriginalName());
            request()->image_md->move(public_path('ebooks').'/'.str_slug($issue->issue_no).'/', $image_mdName);
            $ebook->image_md = $image_mdName;  
        }

         if($request->file('image_sm')){
            $image_smName = preg_replace('/\s+/','-',time().'-ebook-sm-'.$request->file('image_sm')->getClientOriginalName());
            request()->image_sm->move(public_path('ebooks').'/'.str_slug($issue->issue_no).'/', $image_smName);
            $ebook->image_sm = $image_smName;  
        }


        $ebook->url = str_slug($request->url);     
        $ebook->created_by = \Auth::user()->id;
        $ebook->save();
        return redirect()->route('ebooks.index');  

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
       return view('magzine.ebook.show',compact('ebook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        $issues =  Issue::pluck('issue_no','id')->prepend('-- select Issue --','');
        return view('magzine.ebook.edit',compact('issues','ebook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        //  request()->validate(['title' =>'required',
               
        //       'url' =>'required',
        //       'topic_1'=>'required',
        //       'ebook_script'=>'required',
        //       'issue_id'=>'required',
        //       'ebook_image' =>'required',
        //       'magazine_image' =>'required',
        //       'image_sm' =>'required',
    
        //   ]);
        $issue = Issue::find($request->issue_id);
      
        $path = public_path('ebooks').'/'.str_slug($issue->issue_no).'/';
        if($request->file('ebook_image')){
            $ebook_imageName = preg_replace('/\s+/','-',time().'-ebook-'.$request->file('ebook_image')->getClientOriginalName());
            if(request()->ebook_image->move($path, $ebook_imageName)){                  
                if(File::exists($path.$ebook->ebook_image)){                  
                    \File::delete($path.$ebook->ebook_image);                         
                }
                $ebook->ebook_image = $ebook_imageName;
            }
        }
        if($request->file('magazine_image')){
            $magazine_imageName = preg_replace('/\s+/','-',time().'-ebook-'.$request->file('magazine_image')->getClientOriginalName());
            if(request()->magazine_image->move($path, $magazine_imageName)){                  
                if(File::exists($path.$ebook->magazine_image)){                  
                    \File::delete($path.$ebook->magazine_image);                         
                }
                $ebook->magazine_image = $magazine_imageName;
            }
        }

        if($request->file('image_md')){
            $image_mdName = preg_replace('/\s+/','-',time().'-ebook-md-'.$request->file('image_md')->getClientOriginalName());
            if(request()->image_md->move($path, $image_mdName)){                  
                if(File::exists($path.$ebook->image_md)){                  
                    \File::delete($path.$ebook->image_md);                         
                }
                $ebook->image_md = $image_mdName;
            }
        }

        if($request->file('image_sm')){
             $image_smName = preg_replace('/\s+/','-',time().'-ebook-sm-'.$request->file('image_sm')->getClientOriginalName());
            if(request()->image_sm->move($path, $image_smName)){                  
                if(File::exists($path.$ebook->image_sm)){       
                    \File::delete($path.$ebook->image_sm);                         
                }               

             $ebook->image_sm = $image_smName;
            }
        }

         $ebook->url = str_slug($request->url);     
         $ebook->modified_by = \Auth::user()->id;              
         $ebook->update($request->except('ebook_image','magazine_image','image_md','image_sm','url','modified_by'));
         $ebook->save();
         return redirect()->route('ebooks.index');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
         $ebook->active_flag = 0;
        $ebook->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Ebook '.$ebook->title.' deactiveted !');
         return redirect()->route('ebooks.index');
    }

    public function reactivate(Ebook $ebook)
    {        

       $ebook->active_flag = 1;
       $ebook->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Ebook '.$ebook->title.' Activeted !');
       return redirect()->route('ebooks.index');
    }

      public function metatag(Request $request, $ebook)
    {
        $meta = Ebook::findOrFail($ebook);
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
        Session::flash('message', 'The Ebook ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
