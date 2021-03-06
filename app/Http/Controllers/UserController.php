<?php

namespace App\Http\Controllers;
Use Session;
use App\User;
use Illuminate\Http\Request;
//เรียกใช้ library Input แล้วสร้าง alias ว่า Input
use Illuminate\Support\Facades\Input as Input;

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
                'email'=>'required|email|max:255|unique:users',
                'name'=>'required|max:255|unique:users', 
                'password'=>'required|min:8',
                'password_confirmation'=>'required|min:8|same:password',                                                                       
        ]);

        $user = new User(
        [
            'facebook_id'=>'0',
            'name'=>$request->get('name'),  
            'detail'=>'0',            
            'email'=>$request->get('email'),            
            'profile'=>'https://image.flaticon.com/icons/svg/1865/1865950.svg',            
            'password'=>md5($request->get('password')),
            'stories'=>'0',             
            'following'=>'0',
            'followers'=>'0',  
            'notification'=>'0',                        
            'link'=>'0',    
            'boons'=>'0',              
            'cards'=>'0',              
            'power'=>'0',             
        ]
        );
        $user->save();
        $session_user = User::where('email', '=',$request->get('email'))->first();
        Session::put('user_id',$session_user->id);
        return redirect('/');
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
            'detail'=>'required',                   
             ]);        
            $user  = User::find($id);
            if(Input::hasFile('file')){
                $file = Input::file('file');
                $time = time().".jpg";
                //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
                $file->move('profile/', $file->getClientOriginalName());
                rename('profile/'.$file->getClientOriginalName(),'profile/'.$time);
                $user ->profile = '/'.'profile/'.$time;
            }
         
         $user ->email = $request->get('email');
         $user ->name = $request->get('name');
         $user ->detail = $request->get('detail');         
         $user ->save();
         return redirect('/');  
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
