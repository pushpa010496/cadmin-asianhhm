<?php

namespace App\Http\Controllers;

use App\Models\ReportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Session;
class ReportCategoryController extends Controller
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
        $reports = ReportCategory::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $reports = ReportCategory::orderBy('id', 'desc')->paginate(10);
         }
        $active = ReportCategory::where('active_flag', 1);
        return view('reports.index', compact('reports', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.create');
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
            'title' => 'required',
            'url'   =>  'required'
        ]);
        $report_category = new ReportCategory($request->except('url'));
        $report_category->url = Str::slug($request->url, "-");        
        $report_category->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The event \"<a href='reportcategories/$report_category->title'>" . $report_category->title . "</a>\" was Created.");

        return redirect()->route('reportcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ReportCategory $reportcategory)
    {
        
        return view('reports.show',compact('reportcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportCategory $reportcategory)
    {
          return view('reports.edit',compact('reportcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportCategory $reportCategory)
    {
         request()->validate([
            'title' => 'required',
            'url'   =>  'required'
           
        ]);
        $reportCategory->update($request->except('url'));
        $reportCategory->url = Str::slug($request->url, "-");
        
        $reportCategory->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The event \"<a href='reportcategories/$reportCategory->title'>" . $reportCategory->title . "</a>\" was Updated.");

        return redirect()->route('reportcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportCategory $reportcategory)
    {

        
        $reportcategory->active_flag = 0;
        $reportcategory->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Report Category ' . $reportcategory->title . ' was De-Activated.');
        return redirect()->route('reportcategories.index');
    }

    public function reactivate(ReportCategory $reportCategory,$id)
    {

        $report = ReportCategory::findOrFail($id);
        $report->active_flag = 1;
        $report->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Report Category ' . $report->title . ' was Re-Activated.');

        return redirect()->route('reportcategories.index');
    }

      public function metatag(Request $request,$id)
    {
        $meta = ReportCategory::findOrFail($id);
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
        Session::flash('message', 'The Report Category ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
