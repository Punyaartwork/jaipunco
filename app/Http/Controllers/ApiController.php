<?php

namespace App\Http\Controllers;
use App\Post;
use App\Draw;
use App\Tag;
use Illuminate\Http\Request;

class ApiController extends Controller
{
        public function postnew(){
            $data = Post::with('user')->with('tag')->orderBy('id','desc')->paginate(10);
            //$data = Post::orderBy('id','desc')->paginate(10);
            return response()->json($data);
        }
    
        public function posttop(){
            $data = Post::with('tag')->orderBy('postLike','desc')->paginate(10);
            return response()->json($data);
        }
    
        public function tagnew(){
            $data = Tag::with('type')->orderBy('id','desc')->paginate(10);
            //$data = Post::orderBy('id','desc')->paginate(10);
            return response()->json($data);
        }
    
        public function tagtop(){
            $data = Tag::with('type')->orderBy('tagVotes','desc')->paginate(10);
            return response()->json($data);
        }
    
        public function tagid($id){
            $data = Post::with('tag')->where('tag_id', $id)->orderBy('id','desc')->paginate(10);
            return response()->json($data);
        }

        public function draw(){
            $data = Draw::all();
            return response()->json($data);
        }
}
