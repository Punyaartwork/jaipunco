<?php

namespace App\Http\Controllers;
use App\Drawname;
use Illuminate\Http\Request;

class DrawnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drawnames = Drawname::all()->toArray();
        return view('Drawname.index',compact('drawnames'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        return view('drawname.create');
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
            'user_id'=>'required',
            'drawName'=>'required',
            'drawDetail'=>'required',            
            'drawTag'=>'required',
            'drawUse'=>'required',
            ]);
        $type = new Drawname(
        [
            'user_id'=>$request->get('user_id'),
            'drawName'=>$request->get('drawName'),
            'drawDetail'=>$request->get('drawDetail'),            
            'drawTag'=>$request->get('drawTag'),
            'drawUse'=>$request->get('drawUse'),
            'drawTime'=>time(),    
            'draw_ip'=>$request->getClientIp()           
        ]
        );
        $type->save();
        return redirect()->route('drawname.create')->with('success','!!!!!!SAVED!!!!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drawname = Drawname::find($id);
        return view('drawname.edit',compact('drawname','id'));
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
            'drawName'=>'required',
            'drawDetail'=>'required',            
            'drawTag'=>'required',
            'drawUse'=>'required'
            ]);        
        $drawname = Drawname::find($id);
        $drawname->user_id = $request->get('user_id');
        $drawname->drawName = $request->get('drawName');
        $drawname->drawDetail = $request->get('drawDetail');        
        $drawname->drawTag = $request->get('drawTag');
        $drawname->drawUse = $request->get('drawUse');        
        $drawname->save();
        return redirect()->route('drawname.index')->with('success','!!!!!!EDITED!!!!!!');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drawname = Drawname::find($id);
        $drawname->delete();
        return redirect()->route('drawname.index')->with('success','!!!!DELETED!!!!');
    }
}