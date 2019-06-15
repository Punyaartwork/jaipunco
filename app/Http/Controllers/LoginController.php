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
            return redirect('/');
        }
    }

    public function checkfacebook(Request $request)
    {

        $session_user = User::where([['facebook_id', '=',$request->get('hdnFbID')]])->first();
        if ($session_user === null) {
            $strPicture = "https://graph.facebook.com/".$request->get('hdnFbID')."/picture?type=large";
            $strLink = "https://www.facebook.com/app_scoped_user_id/".$request->get('hdnFbID')."/";
            $user = new User(
            [
                'facebook_id'=>$request->get('hdnFbID'),
                'name'=>$request->get('hdnName'),  
                'detail'=>'...',            
                'email'=>$request->get('hdnEmail'),            
                'profile'=>$strPicture,            
                'password'=>'0',
                'stories'=>'0',             
                'following'=>'0',
                'followers'=>'0',  
                'notification'=>'0',                        
                'link'=>$strLink,              
                'boons'=>'0',              
                'cards'=>'0',              
                'power'=>'0',   
            ]
            );
            $user->save();
            $session_user = User::where('email', '=',$request->get('hdnEmail'))->first();
            Session::put('user_id',$session_user->id);            
            return redirect('/'); 
        }else{
            Session::put('user_id',$session_user->id);
            return redirect('/'); 
        }
    }

    public function logout() {
        Session::forget('user_id');
		//Auth::logout();		
		return redirect('/');
	}
}
