<?php

namespace App\Http\Controllers;
Use Session;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',                                                                     
        ]);
        $session_user = User::where([['email', '=',$request->get('email')],['password', '=',md5($request->get('password'))]])->first();
        if ($session_user === null) {
            $comment = "Invalid email or password";
            return view('user.login',compact('comment')); 
        }else{
            Session::put('user_id',$session_user->id);
            return redirect()->route('feed.top')->with('success',"!!!!!SUCCESS!!!!!!");
        }
    }

    public function logout() {
        Session::forget('user_id');
		//Auth::logout();		
		return redirect('/');
	}
}
