<?php

namespace App\Http\Controllers;

use App\Models\IndustryReport;
use Illuminate\Http\Request;
use App\Http\Requests\IndustryReportRequest;
use Illuminate\Support\Str;
use \Session;


class IndustryReportController extends Controller
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
        $report = IndustryReport::where('title1', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $report = IndustryReport::orderBy('id', 'desc')->paginate(10);
         }
        $active = IndustryReport::where('active_flag', 1);
        
        return view('knowledgebank.reports.index', compact('report','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        return view('knowledgebank.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(IndustryReportRequest $request)
    {
      
         $report = new IndustryReport;
         if($request->file('image')){
            $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
            request()->image->move(public_path('knowledgebank/reports'), $imageName);
            $report->image = $imageName; 
            }
         $report->date = $request->date;
         $report->title1 = $request->title1;
         $report->title2 = $request->title2;
        $report->short_description = $request->short_description;
         $report->author_details = $request->author_details;
         $report->full_report = $request->full_report;
         $report->url = Str::slug($request->url);         
         $report->active_flag = $request->active_flag;
         $report->created_by = \Auth::user()->id;
         $report->meta_title = $request->title;
         $report->meta_description = $request->short_description;
         $report->save();
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', $report->title1.' Has created');

        return redirect()->route('industryreport.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IndustryReport  $industryReport
     * @return \Illuminate\Http\Response
     */
    public function show(IndustryReport $industryreport)
    {
       return view('knowledgebank.reports.show',compact('industryreport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IndustryReport  $industryReport
     * @return \Illuminate\Http\Response
     */
    public function edit(IndustryReport $industryreport)
    {
        return view('knowledgebank.reports.edit',compact('industryreport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IndustryReport  $industryReport
     * @return \Illuminate\Http\Response
     */
    public function update(IndustryReportRequest $request, IndustryReport $industryreport)
    {
        if($request->file('image')){
            $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
            request()->image->move(public_path('knowledgebank/reports'), $imageName);
            $industryreport->image = $imageName; 
            }
        
         $industryreport->date = $request->date;
         $industryreport->title1 = $request->title1;
         $industryreport->title2 = $request->title2;
          $industryreport->title2 = $request->title2;
         $industryreport->short_description = $request->short_description;
         $industryreport->full_report = $request->full_report;
         $industryreport->url = Str::slug($request->url);         
         $industryreport->active_flag = $request->active_flag;
         $industryreport->updated_by = \Auth::user()->id;
         $industryreport->meta_title = $request->title;
         $industryreport->meta_description = $request->short_description;
         $industryreport->save();
         Session::flash('message_type', 'success');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', $industryreport->title1.' record updated');
         return redirect()->route('industryreport.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IndustryReport  $industryReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndustryReport $industryreport)
    {
        $industryreport->active_flag = 0;
        $industryreport->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'danger');
        Session::flash('message', 'The report ' . $industryreport->title1 . ' was De-Activated.');
        return redirect()->route('industryreport.index');
    }

    public function reactivate(IndustryReport $industryreport)
    {
        $industryreport->active_flag = 1;
        $industryreport->save();
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Report ' . $industryreport->title1 . ' was Re-Activated.');

        return redirect()->route('industryreport.index');
    }
       public function metatag(Request $request,$id)
    {

        $meta = IndustryReport::findOrFail($id);
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
        Session::flash('message', 'The Report ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
