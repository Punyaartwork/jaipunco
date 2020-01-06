<?php

namespace App\Http\Controllers;
use App\Locat;
use Illuminate\Http\Request;

class LocatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {   
         $locats = Locat::all();
         return view('locat.index',compact('locats'));    
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('locat.create');        
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
             'locat'=>'required',
             'locatPhoto'=>'required',                                                       
             ]);
         $locat = new locat(
         [
            'locat'=>$request->get('locat'),
            'locatPhoto'=>0,  
            'locatBg'=>0,  
            'locatColor'=>0,  
            'locatLatitude'=>$request->get('locatLatitude'),  
            'locatLongitude'=>$request->get('locatLongitude'),  
            'locatDistance'=>$request->get('locatDistance'),  
            'locatItem'=>0, 
            'locatTime'=>time(),   
         ]
         );
         $locat->save();
         return redirect()->route('locat.create')->with('success','!!!!!!SAVED!!!!!!');
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
         $locat = Locat::find($id);
         return view('locat.edit',compact('locat','id'));
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
                'locat'=>'required',
                'locatPhoto'=>'required',            
             ]);        
         $locat  = Locat::find($id);
         $locat ->locat = $request->get('locat');
         $locat ->locatPhoto = $request->get('locatPhoto');
         $locat ->locatBg = $request->get('locatBg');
         $locat ->locatColor = $request->get('locatColor');
         $locat ->locatLatitude = $request->get('locatLatitude');  
         $locat ->locatLongitude = $request->get('locatLongitude');  
         $locat ->locatDistance = $request->get('locatDistance');     
         $locat ->locatItem = $request->get('locatItem');    
         $locat ->save();
         return redirect()->route('locat.index')->with('success','!!!!!!EDITED!!!!!!');     
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $locat = Locat::find($id);
         $locat->delete();
         return redirect()->route('locat.index')->with('success','!!!!DELETED!!!!');
     }
}
