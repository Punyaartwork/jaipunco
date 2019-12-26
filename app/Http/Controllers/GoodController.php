<?php

namespace App\Http\Controllers;
use App\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {   
         $goods = Good::all();
         return view('good.index',compact('goods'));    
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('good.create');        
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
             'good'=>'required',
             'goodDetail'=>'required',                                                       
             ]);
         $good = new Good(
         [
            'good'=>$request->get('good'),
            'goodPhoto'=>0,
            'goodDetail'=>$request->get('goodDetail'),      
            'goodBg'=>'#fff',                       
            'goodColor'=>'#000',         
            'goodItem'=>0, 
            'goodTags'=>0,
            'goodTime'=>time(),    
            'good_ip'=>$request->getClientIp(),    
            'goodLatitude'=>$request->get('goodLatitude'),  
            'goodLongitude'=>$request->get('goodLongitude'),  
            'goodDistance'=>$request->get('goodDistance'),  
            'goodOnline'=>0,                                    
         ]
         );
         $good->save();
         return redirect()->route('good.create')->with('success','!!!!!!SAVED!!!!!!');
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $good = Good::find($id);
         return view('good.edit',compact('good','id'));
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
                'good'=>'required',
                'goodDetail'=>'required',            
             ]);        
         $good  = Good::find($id);
         $good ->good = $request->get('good');
         $good ->goodPhoto = $request->get('goodPhoto');
         $good ->goodDetail = $request->get('goodDetail');
         $good ->goodBg = $request->get('goodBg');
         $good ->goodColor = $request->get('goodColor');
         $good ->goodItem = $request->get('goodItem');    
         $good ->goodTags = $request->get('goodTags');  
         $good ->goodLatitude = $request->get('goodLatitude');  
         $good ->goodLongitude = $request->get('goodLongitude');  
         $good ->goodDistance = $request->get('goodDistance');      
         $good ->save();
         return redirect()->route('good.index')->with('success','!!!!!!EDITED!!!!!!');     
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $good = Good::find($id);
         $good->delete();
         return redirect()->route('good.index')->with('success','!!!!DELETED!!!!');
     }
}
