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
            $commentlogin = "Invalid email or password";
            return view('user.login',compact('commentlogin')); 
        }else{
            Session::put('user_id',$session_user->id);
            return redirect('/');
        }
    }

    public function checkfacebook(Request $request)
    {
        $session_user = User::where([['facebook_id', '=',$request->get('hdnFbID')]])->first();
        if ($session_user === null) {
            $strPicture = "https://graph.facebook.com/".$request->get('hdnFbID')."/picture?type=large";
            $strLink = "https://www.facebook.com/app_scoped_user_id/".$request->get('hdnFbID')."/";
            $user = User::create([
                'facebook_id' => $request->get('hdnFbID'),            
                'name' =>$request->get('hdnName'),  
                'detail' => '...',                       
                'email' => $request->get('hdnEmail'),     
                'profile' => $strPicture,                         
                'password' =>0,
                'cards' => 0, 
                'followers' => 0,                                    
                'following' => 0,   
                'notification' => 0,
                'link'=> $strLink,
                'api_token'=> \Session::get('api')               
            ]);
            $session_user = User::where('email', '=',$request->get('hdnEmail'))->first();
            Session::put('user_id',$session_user->id);            
            return redirect('/logined'); 
        }else{
            $session_user = User::where('email', '=',$request->get('hdnEmail'))->first();       
            $session_user->api_token = Session::get('api');
            $session_user->save();  
            return redirect('/logined'); 
        }
    }

    public function logout() {
        Session::forget('user_id');
		//Auth::logout();		
        return redirect('/logined'); 
	}
}
