<?php

namespace App\Http\Controllers;
use App\Card;
use App\Draw;
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
        return view('card.edit',compact('card','id'));
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
            'user_id'=>'required',
            'card' => 'required',
            'cardPhoto' => 'required',             
            'cardView' => 'required',
            'cardLike' => 'required',
            'cardComment' => 'required',
            'cardShare' => 'required',             
        ]);        
        $card  = Card::find($id);
        $card ->user_id = $request->get('user_id');
        $card ->card = $request->get('card');
        $card ->cardPhoto = $request->get('cardPhoto');         
        $card ->cardView = $request->get('cardView');
        $card ->cardLike = $request->get('cardLike');
        $card ->cardComment = $request->get('cardComment');
        $card ->cardShare = $request->get('cardShare');         
        $card ->card_ip = $request->getClientIp();  
        $card ->save();
        return redirect()->route('card.index')->with('success','!!!!!!EDITED!!!!!!');  
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
        $card->delete();
        return redirect()->route('card.index')->with('success','!!!!DELETED!!!!');
    }
}