<?php

namespace App\Http\Controllers;
use App\Draw;
use Illuminate\Http\Request;
//เรียกใช้ library Input แล้วสร้าง alias ว่า Input
use Illuminate\Support\Facades\Input as Input;

class DrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $draws = Draw::all()->toArray();
        return view('img.index',compact('draws'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        return view('img.create');
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
        'drawname_id'=>'required',
        ]);        

        if(Input::hasFile('file')){
        $file = Input::file('file');
        $time = time().".png";
        //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
                $file->move('draw/', $file->getClientOriginalName());
                rename('draw/'.$file->getClientOriginalName(),'draw/'.$time);
                echo "<img src='draw/{$file->getClientOriginalName()}'>";
                $draw = new Draw(
                [
                    'drawname_id'=>$request->get('drawname_id'),
                    'draw'=>'/'.'draw/'.$time
                ]
                );
                $draw->save();
                return redirect()->route('img.create')->with('success','!!!!!!SAVED!!!!!!');
        }
            
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
        $draw = Draw::find($id);
        return view('img.edit',compact('draw','id'));
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
            'drawname_id'=>'required',
            ]);        
        $draw = Draw::find($id);
        $filename = substr($draw->draw,1);
        if(Input::hasFile('file')){
            unlink('.'.$draw->draw);
            //$file = Input::file('file');
            //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
            //$file->move('draw/', $file->getClientOriginalName());
            //rename('draw/'.$file->getClientOriginalName(),$filename);
            //$draw->draw = '/'.'draw/'.$time;
        }
        
        $draw->drawname_id = $request->get('drawname_id');
        
        $draw->save();
        return redirect()->route('img.index')->with('success','!!!!!!EDITED!!!!!!');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $draw = Draw::find($id);
        $draw->delete();
        return redirect()->route('img.index')->with('success','!!!!DELETED!!!!');
    }
}