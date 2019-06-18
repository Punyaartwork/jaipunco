<?php

namespace App\Http\Controllers;

use App\Post;
use App\Draw;
use App\Tag;
use App\User;
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
         $posts = Post::with('tag')->orderBy('id','desc')->get();
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
            'user_id'=>\Session::get('user_id'),
            'tag_id'=>$request->tag_id,  
            'postName'=>$request->title,            
            'post'=>$request->content,    
            'postDraw'=>'/draw/1556344234.png',                   
            'postView'=>'0',            
            'postLike'=>'0',
            'postComment'=>'0',
            'postShare'=>'0',            
            'postTime'=>time(),             
            'post_ip'=>$request->getClientIp()             
        ]
        );
        $post->save();
        $user = User::find(\Session::get('user_id'));
        $user->power += 100;
        $user->stories += 1;
        $user->save();
        $tag = Tag::find($request->tag_id);
        $tag->tagStories += 1;
        $tag->save();
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
         $draws = Draw::orderBy('id','desc')->get();    
         return view('post.edit',compact('post','id','draws'));
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
        $post  = Post::find($id);
        if($post->user_id == \Session::get('user_id')){
            $this->validate($request,[
                'tag_id' => 'required',
                'postName' => 'required',
                'post' => 'required',
                'postDraw' => 'required',                
                ]);        
            $post ->tag_id = $request->get('tag_id');
            $post ->postname = $request->get('postName');
            $post ->post = $request->get('post');
            $post ->postDraw = $request->get('postDraw');         
            $post ->post_ip = $request->getClientIp();  
            $post ->save();
            return redirect('/more')->with('success','!!!!!!EDITED!!!!!!');     
        }else{
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
        $post = Post::find($id);
        if($post->user_id == \Session::get('user_id')){
            $user = User::find(\Session::get('user_id'));
            $user->power -= 100;
            $user->stories -= 1;        
            $user->save();
            $post->delete();
            return back()->with('success','!!!!DELETED!!!!');    
        } else{
            return back();
        } 
     }
}