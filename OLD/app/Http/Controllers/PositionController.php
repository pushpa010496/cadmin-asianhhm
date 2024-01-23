<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use App\User;
use \Session;

class PositionController extends Controller
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
        $positions = Position::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $positions = Position::orderBy('id', 'desc')->paginate(10);
         }
        $active = Position::where('active_flag', 1);
        return view('positions.index', compact('positions', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $positions = new Position();

        request()->validate([
            'position' => 'required|max:255',            
        ]);
        
       
        $positions->position = ucfirst($request->position);
    
        $positions->active_flag = $request->input("active_flag");
        // $positions->author_id = $request->user()->id;
        $positions->author_id = '1';
        $positions->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The position " . $positions->position . " was Created.");

        return redirect()->route('positions.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $Position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $Position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $Position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
       request()->validate([
            'position' => 'required|max:255',            
        ]);
        
       
       
        $position->position = ucfirst($request->position);
        
        $position->active_flag = $request->active_flag;
        // $position->author_id = $request->user()->id;
        $position->author_id ='1';

        $position->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The Positions " . $position->position . " was Updated.");

        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $Position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
       $position->active_flag = 0;
        $position->save();

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Positions ' . $position->position . ' was De-Activated.');

        return redirect()->route('Position.index');
    }

    public function reactivate(Position $position,$id)
    {

        $Position = Position::findOrFail($id);
        $Position->active_flag = 1;
        $Position->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Positions ' . $position->position . ' was Re-Activated.');

        return redirect()->route('positions.index');
    }
   
}
