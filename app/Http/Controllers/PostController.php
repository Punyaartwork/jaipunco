<?php

namespace App\Http\Controllers;

use App\Post;
use App\Draw;
use Illuminate\Http\Request;

class PostController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $posts = Post::with('tag')->get();
         return view('post.index',compact('posts'));    
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
        $draws = Draw::all()->toArray();
        $tags = Tag::all()->toArray();      
        $users = User::all()->toArray();            
        return view('post.create',compact('draws','tags','users'));          
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
        $post = new Post(
        [
            'user_id'=>$request->user_id,
            'tag_id'=>$request->tag_id,  
            'postName'=>$request->title,            
            'post'=>$request->content,    
            'postDraw'=>$request->postDraw,                        
            'postView'=>'0',            
            'postLike'=>'0',
            'postComment'=>'0',
            'postShare'=>'0',            
            'postTime'=>time(),             
            'post_ip'=>$request->getClientIp()             
        ]
        );
        $post->save();
        return redirect()->route('post.create')->with('success','!!!!!!SAVED!!!!!!');
       // return response()->json($response); 
 
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
         $post = Post::find($id);   
         return view('post.edit',compact('post','id'));
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
             'tag_id' => 'required',
             'postName' => 'required',
             'post' => 'required',
             'postDraw' => 'required',             
             'postView' => 'required',
             'postLike' => 'required',
             'postComment' => 'required',
             'postShare' => 'required',             
             ]);        
         $post  = Post::find($id);
         $post ->user_id = $request->get('user_id');
         $post ->tag_id = $request->get('tag_id');
         $post ->postname = $request->get('postName');
         $post ->post = $request->get('post');
         $post ->postDraw = $request->get('postDraw');         
         $post ->postView = $request->get('postView');
         $post ->postLike = $request->get('postLike');
         $post ->postLike = $request->get('postComment');
         $post ->postLike = $request->get('postShare');         
         $post ->post_ip = $request->getClientIp();  
         $post ->save();
         return redirect()->route('post.index')->with('success','!!!!!!EDITED!!!!!!');  
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $post = Post::find($id);
         $post->delete();
         return redirect()->route('post.index')->with('success','!!!!DELETED!!!!');
     }
}