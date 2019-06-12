<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Boon;
use App\User;
use App\Card;


class LikeController extends Controller
{
    
    public function isLikedByMe($id)
    {
        //$post = Post::findOrFail($id)->first();
        $post = Post::findOrFail($id);        
        if (Like::whereUserId(session('user_id'))->wherePostId($post->id)->where('likeType',1)->exists()){
            return 'true';
        }
        return 'false';
    }
    
    public function like($id)
    {
        $existing_like = Like::withTrashed()->wherePostId($id)->whereUserId(session('user_id'))->where('likeType',1)->first();
        $post = Post::find( $id );
        if (is_null($existing_like)) {
            Like::create([
                'post_id' => $id,
                'user_id' => session('user_id'),
                'likeType' => 1,                
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

    public function isLikedBoonByMe($id)
    {
        //$post = Post::findOrFail($id)->first();
        $boon = Boon::findOrFail($id);        
        if (Like::whereUserId(session('user_id'))->wherePostId($boon->id)->where('likeType',2)->exists()){
            return 'true';
        }
        return 'false';
    }
    
    public function likeBoon($id)
    {
        $existing_like = Like::withTrashed()->wherePostId($id)->whereUserId(session('user_id'))->where('likeType',2)->first();
        $boon = Boon::find( $id );
        if (is_null($existing_like)) {
            Like::create([
                'post_id' => $id,
                'user_id' => session('user_id'),
                'likeType' => 2,                                
            ]);
            $boon->boonLike += 10;
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                $boon->boonLike -= 10;                
            } else {
                $existing_like->restore();
                $boon->boonLike += 10;
            }
        }
        $boon->save();        
    }

    public function isLikedCardByMe($id)
    {
        //$post = Post::findOrFail($id)->first();
        $card = Card::findOrFail($id);        
        if (Like::whereUserId(session('user_id'))->wherePostId($card->id)->where('likeType',3)->exists()){
            return 'true';
        }
        return 'false';
    }

    public function likeCard($id)
    {
        $existing_like = Like::withTrashed()->wherePostId($id)->whereUserId(session('user_id'))->where('likeType',3)->first();
        $card = Card::find( $id );
        if (is_null($existing_like)) {
            Like::create([
                'post_id' => $id,
                'user_id' => session('user_id'),
                'likeType' => 3,                                
            ]);
            $card->cardLike += 10;
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                $card->cardLike -= 10;                
            } else {
                $existing_like->restore();
                $card->cardLike += 10;
            }
        }
        $card->save();        
    }
}
