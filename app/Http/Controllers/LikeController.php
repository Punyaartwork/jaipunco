<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\User;

class LikeController extends Controller
{
    
    public function isLikedByMe($id)
    {
        //$post = Post::findOrFail($id)->first();
        $post = Post::findOrFail($id);        
        if (Like::whereUserId(session('user_id'))->wherePostId($post->id)->exists()){
            return 'true';
        }
        return 'false';
    }
    
    public function like($id)
    {
        $existing_like = Like::withTrashed()->wherePostId($id)->whereUserId(session('user_id'))->first();
        $post = Post::find( $id );
        if (is_null($existing_like)) {
            Like::create([
                'post_id' => $id,
                'user_id' => session('user_id')
            ]);
            $post->postLike += 1;
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                $post->postLike -= 1;                
            } else {
                $existing_like->restore();
                $post->postLike += 1;
            }
        }
        $post->save();        
    }
}
