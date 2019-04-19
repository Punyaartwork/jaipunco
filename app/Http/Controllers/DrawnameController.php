<?php

namespace App\Http\Controllers;
use App\Drawname;
use Illuminate\Http\Request;
//เรียกใช้ library Input แล้วสร้าง alias ว่า Input
use Illuminate\Support\Facades\Input as Input;

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
         return view('drawname.index',compact('drawnames'));   
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
            'drawUse'=>'required',
            ]);
        if(Input::hasFile('file')){
            $file = Input::file('file');
            $time = time().".png";
            //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
            $file->move('drawtag/', $file->getClientOriginalName());
            rename('drawtag/'.$file->getClientOriginalName(),'drawtag/'.$time);
        }
        $drawname = new Drawname(
        [
            'user_id'=>$request->get('user_id'),
            'drawName'=>$request->get('drawName'),
            'drawDetail'=>$request->get('drawDetail'),            
            'drawTag'=>'drawtag/'.$time,
            'drawUse'=>$request->get('drawUse'),
            'drawTime'=>time(),    
            'draw_ip'=>$request->getClientIp()           
        ]
        );
        $drawname->save();
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
            if(Input::hasFile('file')){
                $file = Input::file('file');
                $time = time().".png";
                //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
                $file->move('drawtag/', $file->getClientOriginalName());
                rename('drawtag/'.$file->getClientOriginalName(),'drawtag/'.$time);
            }     
        $drawname = Drawname::find($id);
        $drawname->user_id = $request->get('user_id');
        $drawname->drawName = $request->get('drawName');
        $drawname->drawDetail = $request->get('drawDetail');        
        $drawname->drawTag = 'drawtag/'.$time;
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