<?php

namespace App\Http\Controllers;

use App\Boon;
use App\User;
use Illuminate\Http\Request;

class BoonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $boons = Boon::with('user')->get();
        return view('boon.index',compact('boons'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Session::has('user_id')){
            return view('boon.create'); 
        }else{
            return view('user.login');
        }
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
            'boonName' => 'required',
            'boon' => 'required',              
        ]);       
        $boon = new Boon(
        [
            'user_id'=>\Session::get('user_id'),
            'boonName'=>$request->boonName,            
            'boon'=>$request->boon,                   
            'boonView'=>'0',            
            'boonLike'=>'0',
            'boonComment'=>'0',
            'boonShare'=>'0',            
            'boonTime'=>time(),             
            'boon_ip'=>$request->getClientIp()             
        ]
        );
        $boon->save();
        $user = User::find(\Session::get('user_id'));
        $user->power += 100;
        $user->boons += 1;        
        $user->save();
        return redirect()->route('photo.create')->with('boon_id',$boon->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
         $boon = Boon::with('user')->with('like')->with('comments')->with('photo')->find($id);
         return view('boon.show',compact('boon','id'));
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boon = Boon::find($id);
        return view('boon.edit',compact('boon','id'));
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
        $boon  = boon::find($id);
        if($boon->user_id == \Session::get('user_id')){
            $this->validate($request,[
                'user_id'=>'required',
                'boonName' => 'required',
                'boon' => 'required',             
                'boonView' => 'required',
                'boonLike' => 'required',
                'boonComment' => 'required',
                'boonShare' => 'required',             
            ]);        
            $boon ->user_id = $request->get('user_id');
            $boon ->boonName = $request->get('boonName');
            $boon ->boon = $request->get('boon');         
            $boon ->boonView = $request->get('boonView');
            $boon ->boonLike = $request->get('boonLike');
            $boon ->boonComment = $request->get('boonComment');
            $boon ->boonShare = $request->get('boonShare');         
            $boon ->boon_ip = $request->getClientIp();  
            $boon ->save();
            return redirect('/more')->with('success','!!!!!!EDITED!!!!!!');    
        } else{
            return back();
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
        $boon = Boon::find($id);
        if($boon->user_id == \Session::get('user_id')){
            $user = User::find(\Session::get('user_id'));
            $user->power -= 100;
            $user->boons -= 1;        
            $user->save();
            $boon->delete();
            return back()->with('success','!!!!DELETED!!!!');    
        } else{
            return back();
        } 
    }
}
