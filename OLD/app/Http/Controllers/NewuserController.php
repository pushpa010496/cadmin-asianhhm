<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Role;
use \Session;
use \Redirect;
use Hash;

class NewuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   $user_data=User::get();

        return view('user.index',compact('user_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

             $user = new User();
        
             $message="Record Added";

             $systemid=\Request::ip();

             $user->name=$request->input('name'); 

             $user->email=$request->input('email');

             $user->password=bcrypt($request->input('password'));

            // $user->role=$request->input('role');    

             $user->save();
             $user->attachRole($request->input("role"));
             return redirect()->route('users.index')->with('message', 'New menu Added in your list !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

       if (Auth::user()->can('settings')) {
        return view('user.show', compact('user'));
        }else{
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', "You do not have User permissions");
              return redirect('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(User $user)
    {
       if (Auth::user()->can('settings')) {
        $roles = Role::where('active_flag', 1)->orderBy('name')->pluck('name', 'id');
        return view('user.edit', compact('user','roles'));

        }else{
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
 
            Session::flash('message', "You do not have User permissions");
              return redirect('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, User $user, Role $role)
    {
        if (Auth::user()->can('settings')) {
        $user->name = ucfirst($request->input("name"));
        $user->email = $request->input("email");
         if(!(Hash::check($request->get('old_password'), Auth::user()->password))){
             
        // if (Hash::check(bcrypt($request->input('old_password')), Auth::user()->password))
        // { 
            $password = $user->password = bcrypt($request->input("password"));
        }
        else{
            return redirect()->back()->withErrors([
                    'password' => 'Wrong Password',
            ]);
        }
        $user->active_flag = 1;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
        $user->save();
        $user->roles()->sync($request->input("role"));
        
        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The User \"<a href='users/$user->slug'>" . $user->name . "</a>\" was Updated.");

        return redirect()->route('users.index');

        }else{
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
 
            Session::flash('message', "You do not have User permissions");
              return redirect('home');
        }
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
