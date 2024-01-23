<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;

use App\Roleaccess;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $menu_data=Menu::all();
        return view('access.create',compact('menu_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
              $menu_data=Menu::all();
        return view('access.create',compact('menu_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             $access = new Roleaccess();
        
             $message="Record Added";

             $systemid=\Request::ip();

             $access->role=$request->input('role'); 

             $menus=$request->input('menu');

             $submenu=$request->input('submenu');
            
             $out = array_values($menus);

             $subout=array_values($submenu);

             $menuinfo=json_encode($out);

             $submenuinfo=json_encode($subout);
        
             $access->menuid=$menuinfo;

             $access->submenuid=$submenuinfo;


             print_r($access->menuid);

             print_r($access->submenuid);

            

            

            
             $access->save();

             return redirect()->route('mastermenu.index')->with('message', 'New menu Added in your list !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
