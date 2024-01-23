<?php

namespace App\Http\Controllers;

use App\BookShelf;
use Illuminate\Http\Request;
use Auth;
use File;
use Session;
class BookShelfController extends Controller
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
        $bookshelf = BookShelf::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $bookshelf = BookShelf::orderBy('id', 'desc')->paginate(10);
         }
        $active = BookShelf::where('active_flag', 1);
      return view('knowledgebank.bookshelf.index',compact('bookshelf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('knowledgebank.bookshelf.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       request()->validate(['title' =>'required|unique:projects',
       'bookshelf_image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
       'url'=>'required',
       'sub_title'=>'required'
      
   ]);
      $bookshelf = new BookShelf($request->except(['bookshelf_image','created_by']));
      if($request->file('bookshelf_image')){
        $bookshelf_imagename  = time().'-'.$request->file('bookshelf_image')->getClientOriginalName();
        request()->bookshelf_image->move(public_path('knowledgebank/bookshelf'),$bookshelf_imagename);
        $bookshelf->bookshelf_image = $bookshelf_imagename;

    }
    
    $bookshelf->created_by = Auth::user()->id;
    $bookshelf->url = str_slug($request->url);
    $bookshelf->meta_title = $request->title;
    $bookshelf->save();

    return redirect()->route('bookshelf.index')->with(['create_message'=>'Successfully Created','alert'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookShelf  $bookShelf
     * @return \Illuminate\Http\Response
     */
    public function show(BookShelf $bookshelf)
    { 

       return view('knowledgebank.bookshelf.show',compact('bookshelf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookShelf  $bookShelf
     * @return \Illuminate\Http\Response
     */
    public function edit(BookShelf $bookshelf)
    {

        return view('knowledgebank.bookshelf.edit',compact('bookshelf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookShelf  $bookShelf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookShelf $bookshelf)
    {
        request()->validate(['title' =>'required',
       'bookshelf_image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'url'    =>'required',
       'sub_title'=>'required'
      
   ]);
        $image_name = public_path('knowledgebank/bookshelf')."/".$bookshelf->bookshelf_image;
       

      if(File::exists($image_name)){
        if($request->file('bookshelf_image')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('bookshelf_image')->getClientOriginalName();
        request()->bookshelf_image->move(public_path('knowledgebank/bookshelf'),$imagename);
        $bookshelf->bookshelf_image = $imagename;
        }
        else{
           $bookshelf->bookshelf_image = $bookshelf->bookshelf_image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('bookshelf_image')->getClientOriginalName();
        request()->bookshelf_image->move(public_path('knowledgebank/bookshelf'),$imagename);
        $bookshelf->bookshelf_image = $imagename;
        }

        $bookshelf->updated_by = Auth::user()->id;
        $bookshelf->url =str_slug($request->url);
        $bookshelf->update($request->except(['bookshelf_image','updated_by','url']));
        $bookshelf->meta_title = $request->title;
        $bookshelf->save();
       return redirect()->route('bookshelf.index')->with(['create_message'=>'Successfully Updated','alert'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookShelf  $bookShelf
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookShelf $bookshelf)
    {
        //
        $bookshelf->active_flag = 0;
        $bookshelf->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Bookshelf '.$bookshelf->title.' deactiveted !');
         return redirect()->route('bookshelf.index');
    }
    public function reactivate(BookShelf $bookshelf)
    {        

      $bookshelf->active_flag = 1;
      $bookshelf->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Bookshelf '.$bookshelf->title.' Activeted !');
       return redirect()->route('bookshelf.index');
    }

     public function metatag(Request $request,$bookshelf)
    {


        $meta = BookShelf::findOrFail($bookshelf);
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
        Session::flash('message', 'The Bookshelf ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
   
}
