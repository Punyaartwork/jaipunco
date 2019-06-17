<?php

namespace App\Http\Controllers;
use App\Card;
use App\Draw;
use App\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::all();
        return view('card.index',compact('cards'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $draws = Draw::orderBy('id','desc')->get();
        return view('card.create',compact('draws')); 
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
            'card' => 'required',
            'cardPhoto' => 'required',              
        ]);       
        $card = new Card(
        [
            'user_id'=>\Session::get('user_id'),
            'card'=>$request->card,            
            'cardPhoto'=>$request->cardPhoto,                   
            'cardView'=>'0',            
            'cardLike'=>'0',
            'cardComment'=>'0',
            'cardShare'=>'0',            
            'cardTime'=>time(),             
            'card_ip'=>$request->getClientIp()             
        ]
        );
        $card->save();
        $user = User::find(\Session::get('user_id'));
        $user->power += 100;
        $user->cards += 1;        
        $user->save();
        return redirect()->route('card.index')->with('success','!!!!!!SAVED!!!!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::with('user')->with('like')->with('comments')->find($id);
        return view('card.show',compact('card','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = Card::find($id);
        $draws = Draw::orderBy('id','desc')->get();        
        return view('card.edit',compact('card','id','draws'));
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
        $card  = Card::find($id);
        if($card->user_id == \Session::get('user_id')){
            $this->validate($request,[
                'card' => 'required',
                'cardPhoto' => 'required',               
            ]);        
            $card ->card = $request->get('card');
            $card ->cardPhoto = $request->get('cardPhoto');          
            $card ->card_ip = $request->getClientIp();  
            $card ->save();
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
        $card = Card::find($id);
        if($card->user_id == \Session::get('user_id')){
            $user = User::find(\Session::get('user_id'));
            $user->power -= 100;
            $user->cards -= 1;        
            $user->save();
            $card->delete();
            return back()->with('success','!!!!DELETED!!!!');    
        } else{
            return back();
        } 
    }
}