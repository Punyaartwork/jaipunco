<?php

namespace App\Http\Controllers;
Use Session;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Boon;
use App\Card;
use App\User;

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
         switch ($request->get('commentType')) {
            case "1":
                $post = Post::find($request->get('post_id'));
                $post->postComment += 1;
                $post->save();
                $user = User::find($post->user_id);
                $user->power += 10;
                $user->save();
                break;
            case "2":
                $boon = Boon::find($request->get('post_id'));
                $boon->boonComment += 1;
                $boon->save();
                $user = User::find($boon->user_id);
                $user->power += 10;
                $user->save();
                break;
            case "3":
                $card = Card::find($request->get('post_id'));
                $card->cardComment += 1;
                $card->save();
                $user = User::find($card->user_id);
                $user->power += 10;
                $user->save();
                break;
        }
         return back();
     }
}
