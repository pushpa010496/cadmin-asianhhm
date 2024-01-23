<?php

namespace App\Http\Controllers;

use App\ReaserchInsites;
use Illuminate\Http\Request;
use App\Http\Requests\ReaserchInsitesRequest;
use \Session;
class ReaserchInsitesController extends Controller
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
        $report = ReaserchInsites::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $report = ReaserchInsites::orderBy('id', 'desc')->paginate(10);
         }
        $active = ReaserchInsites::where('active_flag', 1);
        return view('knowledgebank.reaserch.index', compact('report', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('knowledgebank.reaserch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReaserchInsitesRequest $request)
    {
        
         $research = new ReaserchInsites;
         $research->title = $request->title;
         $research->sub_title = $request->sub_title;
         $research->title_tag = $request->title_tag;
         $research->published_date = $request->published_date;
         $research->author_details = $request->author_details;
        $research->short_description = $request->short_description;
         $research->description = $request->description;
         $research->on_home = $request->on_home;
         $research->url = str_slug($request->url);         
         $research->active_flag = $request->active_flag;
         $research->created_by = \Auth::user()->id;
         $research->meta_title = $request->title;
         $research->meta_description = $request->short_description;
         $research->save();
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', $research->title.' created');

         return redirect()->route('reaserchinsites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReaserchInsites  $reaserchInsites
     * @return \Illuminate\Http\Response
     */
    public function show(ReaserchInsites $reaserchinsite)
    {
        
        return view('knowledgebank.reaserch.show',compact('reaserchinsite'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReaserchInsites  $reaserchInsites
     * @return \Illuminate\Http\Response
     */
    public function edit(ReaserchInsites $reaserchinsite)
    {
        
        return view('knowledgebank.reaserch.edit',compact('reaserchinsite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReaserchInsites  $reaserchInsites
     * @return \Illuminate\Http\Response
     */
    public function update(ReaserchInsitesRequest $request, ReaserchInsites $reaserchinsite)
    {

        $reaserchinsite->title = $request->title;
         $reaserchinsite->sub_title = $request->sub_title;
         $reaserchinsite->title_tag = $request->title_tag;
         $reaserchinsite->published_date = $request->published_date;
         $reaserchinsite->author_details = $request->author_details;
         $reaserchinsite->short_description = $request->short_description;
         $reaserchinsite->description = $request->description;
         $reaserchinsite->on_home = $request->on_home;
         $reaserchinsite->url = str_slug($request->url);         
         $reaserchinsite->active_flag = $request->active_flag;
         $reaserchinsite->updated_by = \Auth::user()->id;
         $reaserchinsite->meta_title = $request->title;
         $reaserchinsite->meta_description = $request->short_description;
         $reaserchinsite->save();
         Session::flash('message_type', 'success');
         Session::flash('message_icon', 'hide');
         Session::flash('message_header', 'danger');
         Session::flash('message', $reaserchinsite->title.' record updated');
         return redirect()->route('reaserchinsites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReaserchInsites  $reaserchInsites
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReaserchInsites $reaserchinsite)
    {
          $reaserchinsite->active_flag = 0;
        $reaserchinsite->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', 'The Research ' . $reaserchinsite->title . ' was De-Activated.');
        return redirect()->route('reaserchinsites.index');
    }

      public function reactivate(ReaserchInsites $reaserchinsite)
    {
        
        $reaserchinsite->active_flag = 1;
        $reaserchinsite->save();
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Research ' . $reaserchinsite->title . ' was Re-Activated.');

        return redirect()->route('reaserchinsites.index');
    }
     public function metatag(Request $request,$reaserchinsite)
    {


        $meta = ReaserchInsites::findOrFail($reaserchinsite);
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
        Session::flash('message', 'The ReaserchInsites ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
