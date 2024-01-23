<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Input;
use App\Models\Category;;
use Session;
use App\Http\Requests\IssueRequest;
class IssueController extends Controller
{
   
     public function __construct()
    {
     
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
         if($request->get('search')){
        $search = \Request::get('search'); 
        $data = Issue::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $data = Issue::orderBy('id', 'desc')->paginate(10);
         }
        $active = Issue::where('active_flag', 1);
         //$data=Issue::all();
         return view('magzine.issue.index',compact('data'));
    }  
    public function create()
    {
        $categories =  Category::where('active_flag',1)->pluck('name','id')->prepend('-- select category --','');
        return view('magzine.issue.create',compact('categories'));
    }
    public function store(IssueRequest $request)
    {
        $issue = new Issue($request->except('category'));
        // $issue->category = implode(',', $request->category);
        $issue->created_by = \Auth::user()->id;
        $issue->save();
        if($request->category[0] != ''){
          $issue->categories()->attach($request->category);
        }
        return redirect()->route('issues.index');            
    }  
    public function show(Issue $issue)
    {
        return view('magzine.issue.show',compact('issue'));
    }
    public function edit(Issue $issue)
    {        

        $categories =  Category::where('active_flag',1)->pluck('name','id')->prepend('-- select category --','');
        return view('magzine.issue.edit',compact('issue','categories'));
    }
   
    public function update(Request $request, Issue $issue)
    {       
      request()->validate(['title' => 'required',
        'issue_no'=>'required',
        'active_flag'=>'required',
        'category'=>'required|array|min:1']);   
      if ($issue->update($request->except('category'))) {
              // $issue->category = implode(',', $request->category);
        $issue->modified_by = \Auth::user()->id;
        $issue->save();
        if($request->category[0] != ''){
          $issue->categories()->sync($request->category);
        }
        return redirect()->route('issues.index')->with(['create_message'=>'successfully Updated','alert'=>'success']);
      }            
    }


    public function destroy(Issue $issue)
    {
        $issue->active_flag = 0;
        $issue->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Issue '.$issue->issue_no.' deactiveted !');
         return redirect()->route('issues.index');
    }
    public function reactivate(Issue $issue)
    {        

       $issue->active_flag = 1;
       $issue->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Issue '.$issue->issue_no.' Activeted !');
       return redirect()->route('issues.index');
    }
}
