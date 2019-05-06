<?php

namespace App\Http\Controllers;
Use Session;
use Illuminate\Http\Request;
use App\Comment;

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
     
         Comment::create($input);
    
         return back();
     }
}
