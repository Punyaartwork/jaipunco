<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Mark;
use App\User;

class MarkController extends Controller
{
    
    public function isMarkedByMe($id)
    {
        //$post = Post::findOrFail($id)->first();
        $post = Post::findOrFail($id);        
        if (Mark::whereUserId(session('user_id'))->wherePostId($post->id)->exists()){   
            return 'true';
        }
        return 'false';
    }
    
    public function mark($id)
    {
        $existing_like = Mark::withTrashed()->wherePostId($id)->whereUserId(session('user_id'))->first();
        if (is_null($existing_like)) {
            Mark::create([
                'post_id' => $id,
                'user_id' => session('user_id'),
                'markTime' => time(),                
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();           
            } else {
                $existing_like->restore();
                $existing_like->markTime=time(); 
                $existing_like->save();   
            }
        }
    }
}
