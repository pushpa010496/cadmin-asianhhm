<?php

namespace App\Http\Controllers;

use App\ClientAdverts;
use Illuminate\Http\Request;
use App\Issue;
use File;
use Session;

class ClientAdvertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $clientadverts=ClientAdverts::orderBy('id', 'desc')->paginate(10);
         
          return view('magzine.adverts.index',compact('clientadverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $issues =  Issue::where('active_flag',1)->orderBy('id','desc')->pluck('issue_no','id')->prepend('-- select Issue --','');
        return view('magzine.adverts.create',compact('issues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         request()->validate(['title' =>'required',
            'client_advert_image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'client_advert_cover_image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'url' =>'required'
           
       ]);
        $clientadverts = new ClientAdverts($request->except('client_advert_image','client_advert_cover_image','url'));   
        $issue = Issue::find($request->issue_id);
        if($request->file('client_advert_image')){
        $imageName = preg_replace('/\s+/','-',time().'-advert-'.$request->file('client_advert_image')->getClientOriginalName());
        request()->client_advert_image->move(public_path('clientadverts').'/'.str_slug($issue->issue_no).'/', $imageName);
        $clientadverts->client_advert_image = $imageName;  
        }

        if($request->file('client_advert_cover_image')){
        $cover_imageName = preg_replace('/\s+/','-',time().'-advert-'.$request->file('client_advert_cover_image')->getClientOriginalName());
        request()->client_advert_cover_image->move(public_path('clientadverts').'/'.str_slug($issue->issue_no).'/', $cover_imageName);
        $clientadverts->client_advert_cover_image = $cover_imageName;  
        }

        $clientadverts->url = str_slug($request->url); 
        $clientadverts->created_by = \Auth::id();     
        $clientadverts->save();
        return redirect()->route('clientadverts.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientAdverts  $clientAdverts
     * @return \Illuminate\Http\Response
     */
    public function show(ClientAdverts $clientadvert)
    {     
     return view('magzine.adverts.show',compact('clientadvert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientAdverts  $clientAdverts
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientAdverts $clientadvert)
    {
         $issues =  Issue::where('active_flag',1)->orderBy('id','desc')->pluck('issue_no','id')->prepend('-- select Issue --','');
        return view('magzine.adverts.edit',compact('clientadvert','issues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientAdverts  $clientAdverts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientAdverts $clientadvert)
    {

        request()->validate(['title' =>'required',
           
           'url' =>'required',
            'client_advert_image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'client_advert_cover_image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
           
       ]);
         $issue = Issue::find($request->issue_id);
      
        $path = public_path('clientadverts').'/'.str_slug($issue->issue_no).'/';
        if($request->file('client_advert_image')){
            $imageName = preg_replace('/\s+/','-',time().'-advert-'.$request->file('client_advert_image')->getClientOriginalName());
            if(request()->client_advert_image->move($path, $imageName)){                  
                if(File::exists($path.$clientadvert->client_advert_image)){                  
                    \File::delete($path.$clientadvert->client_advert_image);                         
                }
                $clientadvert->client_advert_image = $imageName;
            }
        }
        if($request->file('client_advert_cover_image')){
            $cover_imageName = preg_replace('/\s+/','-',time().'-advert-'.$request->file('client_advert_cover_image')->getClientOriginalName());
            if(request()->client_advert_cover_image->move($path, $cover_imageName)){                  
                if(File::exists($path.$clientadvert->client_advert_cover_image)){                  
                    \File::delete($path.$clientadvert->client_advert_cover_image);                         
                }
                $clientadvert->client_advert_cover_image = $cover_imageName;
            }
        }

         $clientadvert->url = str_slug($request->url);                   
         $clientadvert->update($request->except('client_advert_image','client_advert_cover_image','url'));  
          $clientadvert->modified_by = \Auth::id();
         if($clientadvert->save())  {          
            return redirect()->route('clientadverts.index');  
         }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientAdverts  $clientAdverts
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientAdverts $clientadvert)
    {
          $clientadvert->active_flag = 0;
        $clientadvert->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Clientadverts '.$clientadvert->title.' deactiveted !');
         return redirect()->route('clientadverts.index');
    }

      public function reactivate(ClientAdverts $clientadvert)
    {        

       $clientadvert->active_flag = 1;
       $clientadvert->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Clientadverts '.$clientadvert->title.' Activeted !');
       return redirect()->route('clientadverts.index');
    }

    public function metatag(Request $request, $clientadvert)
    {
        $meta = ClientAdverts::findOrFail($clientadvert);
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
        Session::flash('message', 'The Clientadverts ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
