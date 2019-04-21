<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {   
         $tags = Tag::with('type')->get();
         return view('tag.index',compact('tags'));    
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('tag.create');        
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
             'type_id'=>'required', 
             'tagname'=>'required',        
             'tagDraw'=>'required',                        
             'tagDetail'=>'required',          
             'tagStories'=>'required', 
             'tagVotes'=>'required',    
             'tagColor'=>'required',                                                          
             ]);
         $tag = new Tag(
         [
             'user_id'=>$request->get('user_id'),
             'type_id'=>$request->get('type_id'),  
             'tagname'=>$request->get('tagname'),            
             'tagDraw'=>$request->get('tagDraw'),            
             'tagDetail'=>$request->get('tagDetail'),            
             'tagStories'=>$request->get('tagStories'),
             'tagVotes'=>$request->get('tagVotes'),
             'tagColor'=>$request->get('tagColor'),          
             'tagDate'=>time(),                                      
         ]
         );
         $tag->save();
         return redirect()->route('tag.create')->with('success','!!!!!!SAVED!!!!!!');
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
         $tag = Tag::find($id);
         return view('tag.edit',compact('tag','id'));
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
             'type_id' => 'required',
             'tagname' => 'required',
             'tagDraw' => 'required',
             'tagDetail' => 'required',
             'tagStories' => 'required',
             'tagVotes' => 'required',
             'tagColor' => 'required',             
             ]);        
         $tag  = Tag::find($id);
         $tag ->user_id = $request->get('user_id');
         $tag ->type_id = $request->get('type_id');
         $tag ->tagname = $request->get('tagname');
         $tag ->tagDraw = $request->get('tagDraw');
         $tag ->tagDetail = $request->get('tagDetail');
         $tag ->tagStories = $request->get('tagStories');
         $tag ->tagVotes = $request->get('tagVotes');
         $tag ->tagColor = $request->get('tagColor');         
         $tag ->save();
         return redirect()->route('tag.index')->with('success','!!!!!!EDITED!!!!!!');     
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $tag = Tag::find($id);
         $tag->delete();
         return redirect()->route('tag.index')->with('success','!!!!DELETED!!!!');
     }
}
