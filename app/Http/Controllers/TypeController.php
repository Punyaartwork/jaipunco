<?php

namespace App\Http\Controllers;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all()->toArray();
        return view('type.index',compact('types'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        return view('type.create');
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
            'type'=>'required',
            'typeDetail'=>'required',
            'typeDraw'=>'required',            
            'typeView'=>'required',
            'typeStories'=>'required'
            ]);
        $type = new Type(
        [
            'type'=>$request->get('type'),
            'typeDetail'=>$request->get('typeDetail'),
            'typeDraw'=>$request->get('typeDraw'),            
            'typeView'=>$request->get('typeView'),
            'typeStories'=>$request->get('typeStories')            
        ]
        );
        $type->save();
        return redirect()->route('type.create')->with('success','!!!!!!SAVED!!!!!!');
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
        $type = Type::find($id);
        return view('type.edit',compact('type','id'));
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
            'type'=>'required',
            'typeDetail'=>'required',
            'typeDraw'=>'required',            
            'typeView'=>'required',
            'typeStories'=>'required'
            ]);        
        $type = Type::find($id);
        $type->type = $request->get('type');
        $type->typeDetail = $request->get('typeDetail');
        $type->typeDraw = $request->get('typeDraw');        
        $type->typeView = $request->get('typeView');
        $type->typeStories = $request->get('typeStories');        
        $type->save();
        return redirect()->route('type.index')->with('success','!!!!!!EDITED!!!!!!');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();
        return redirect()->route('type.index')->with('success','!!!!DELETED!!!!');
    }
}