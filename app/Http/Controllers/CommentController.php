<?php

namespace App\Http\Controllers;
Use Session;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
         $request->validate([
             'body'=>'required',
         ]);
    
         $input = $request->all();
         $input['user_id'] = session('user_id');
         $post = Post::find($request->get('post_id'));
         $post->postComment += 1;
         $post->save();
         Comment::create($input);

         return back();
     }
}
