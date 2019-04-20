<?php

namespace App\Http\Controllers;
Use Session;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $users = User::all();
         return view('user.index',compact('users'));    
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('user.create');        
     }

 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         $this->validate($request,[
             'email'=>'required',
             'name'=>'required', 
             'password'=>'required',                                                                     
             ]);
         $user = new User(
         [
             'facebook_id'=>'0',
             'name'=>$request->get('name'),  
             'detail'=>'0',            
             'email'=>$request->get('email'),            
             'profile'=>'0',            
             'password'=>$request->get('password'),
             'stories'=>'0',             
             'following'=>'0',
             'followers'=>'0',  
             'notification'=>'0',                        
             'link'=>'0',              
         ]
         );
         $user->save();
         $session_user = User::where('email', '=',$request->get('email'))->first();
         Session::put('user_id',$session_user->id);
         return redirect()->route('user.create')->with('success',"!!!!!SUCCESS!!!!!!");
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
         $user = User::find($id);
         return view('user.edit',compact('user','id'));
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
         $this->validate($request,[
            'email'=>'required',
            'name'=>'required', 
            'profile'=>'required',       
            'detail'=>'required',                   
             ]);        
         $user  = User::find($id);
         $user ->email = $request->get('email');
         $user ->name = $request->get('name');
         $user ->profile = $request->get('profile');
         $user ->detail = $request->get('detail');         
         $user ->save();
         return redirect()->route('user.index')->with('success','!!!!!!EDITED!!!!!!');  
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $user = User::find($id);
         $user->delete();
         return redirect()->route('user.index')->with('success','!!!!DELETED!!!!');
     }
}
