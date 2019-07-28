<?php

use Illuminate\Http\Request;
Use App\User;
use App\Card;
use App\Comment;
use App\Chat;
use App\Review;
use App\Follow;
use App\Like;
use App\Drawing;
use App\Store;
use App\Keep;
use App\Draw;
use App\Notification;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('users', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return User::all();
});
 
Route::get('users/{id}', function($id) {
    return User::find($id);
});

Route::get('users/{api}', function($api) {
    return User::where('api_token',$api);
});

Route::post('users', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::put('users/{id}', function(Request $request, $id) {
    $user = User::findOrFail($id);
    $user->update($request->all());

    return $user;
});

Route::delete('users/{id}', function($id) {
    User::find($id)->delete();
    return 204;
});


/*
|--------------------------------------------------------------------------
| POST API Routes Card
|--------------------------------------------------------------------------
*/
Route::get('cards', function() {
    return Card::all();
});
 
Route::get('cards/{id}', function($id) {
    return Card::find($id);
});

Route::post('cards', function(Request $request) {
    //return Card::create($request->all);
    return  $request->post();
});

Route::put('cards/{id}', function(Request $request, $id) {
    $card = Card::findOrFail($id);
    $card->update($request->all());

    return $card;
});

Route::delete('cards/{id}', function($id) {
    Card::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| POST API Routes Comment
|--------------------------------------------------------------------------
*/

Route::get('comments', function() {
    return Comment::all();
});
 
Route::get('comments/{id}', function($id) {
    return Comment::find($id);
});

Route::post('comments', function(Request $request) {
    //return Card::create($request->all);
    return  $request->post();
});

Route::put('comments/{id}', function(Request $request, $id) {
    $comment = Comment::findOrFail($id);
    $comment->update($request->all());

    return $comment;
});

Route::delete('comments/{id}', function($id) {
    Comment::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| POST API Routes Chat
|--------------------------------------------------------------------------
*/

Route::get('chats', function() {
    return Chat::all();
});
 
Route::get('chats/{id}', function($id) {
    return Chat::find($id);
});

Route::post('chats', function(Request $request) {
    //return Card::create($request->all);
    return  $request->post();
});

Route::put('chats/{id}', function(Request $request, $id) {
    $chat = Chat::findOrFail($id);
    $chat->update($request->all());

    return $chat;
});

Route::delete('chats/{id}', function($id) {
    Chat::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| POST API Routes Review
|--------------------------------------------------------------------------
*/

Route::get('reviews', function() {
    return Review::all();
});
 
Route::get('reviews/{id}', function($id) {
    return Review::find($id);
});

Route::post('reviews', function(Request $request) {
    //return Card::create($request->all);
    return  $request->post();
});

Route::put('reviews/{id}', function(Request $request, $id) {
    $review = Review::findOrFail($id);
    $review->update($request->all());
    return $review;
});

Route::delete('reviews/{id}', function($id) {
    Review::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| GET API Routes Follow 
|--------------------------------------------------------------------------
*/

Route::get('follow/{id}/isfollowbyme', function($id) {
    $user = User::findOrFail($id);        
    if (Follow::whereUserId(1)->where($user->id)->exists()){
        return 'true';
    }
    return 'false';
});
Route::get('follow/{id}/followed', function($id) {
    $existing_follow = Follow::withTrashed()->where('fuser_id',$id)->whereUserId(1)->first();
    $user = User::findOrFail($id);
    //$user = User::find($card->user_id);        
    if (is_null($existing_follow)) {
        Follow::create([
            'fuser_id' => $id,
            'user_id' => 1,             
        ]);
        //$follow->cardLike += 10;
        //$user->power += 5;                                             
    } else {
        if (is_null($existing_follow->deleted_at)) {
            $existing_follow->delete();
            //$follow->cardLike -= 10;   
            //$user->power -= 5;                                 
        } else {
            $existing_follow->restore();
            //$follow->cardLike += 10;
            //$user->power += 5;                                 
        }
    }
    //$user->save();        
    $user->save();     
});
/*
|--------------------------------------------------------------------------
| GET API Routes Like
|--------------------------------------------------------------------------
*/

Route::get('like/{id}/islikedbyme', function($id) {
    $card = Card::findOrFail($id);        
    if (Like::whereUserId(1)->whereCardId($card->id)->where('likeType',1)->exists()){
        return 'true';
    }
    return 'false';
});
Route::get('like/{id}/liked', function($id) {
    $existing_like = Like::withTrashed()->whereCardId($id)->whereUserId(1)->where('likeType',1)->first();
    $card = Card::find( $id );
    //$user = User::find($card->user_id);        
    if (is_null($existing_like)) {
        Like::create([
            'card_id' => $id,
            'user_id' => 1,
            'likeType' => 1,                                
        ]);
        $card->cardLike += 10;
        //$user->power += 5;                                             
    } else {
        if (is_null($existing_like->deleted_at)) {
            $existing_like->delete();
            $card->cardLike -= 10;   
            //$user->power -= 5;                                 
        } else {
            $existing_like->restore();
            $card->cardLike += 10;
            //$user->power += 5;                                 
        }
    }
    //$user->save();        
    $card->save();           
});
/*
|--------------------------------------------------------------------------
| GET API Routes Drawing
|--------------------------------------------------------------------------
*/

Route::get('drawing/{id}/isdrawingbyme', function($id) {
    $store = Store::findOrFail($id);       
    if (Drawing::whereUserId(1)->where('store_id',$store->id)->exists()){
        return 'true';
    }
    return 'false';
});
Route::get('drawing/{id}/drawinged', function($id) {
    $existing_drawing = Drawing::withTrashed()->where('store_id',$id)->whereUserId(1)->first();
    $store = Store::find( $id );
    //$user = User::find($card->user_id);        
    if (is_null($existing_drawing)) {
        Drawing::create([
            'store_id' => $id,
            'user_id' => 1,             
        ]);
        //$follow->cardLike += 10;
        //$user->power += 5;                                             
    } else {
        if (is_null($existing_drawing->deleted_at)) {
            $existing_drawing->delete();
            //$follow->cardLike -= 10;   
            //$user->power -= 5;                                 
        } else {
            $existing_drawing->restore();
            //$follow->cardLike += 10;
            //$user->power += 5;                                 
        }
    }
    //$user->save();        
    $store->save();     
});
/*
|--------------------------------------------------------------------------
| GET API Routes Keep
|--------------------------------------------------------------------------
*/

Route::get('keep/{id}/iskeepbyme', function($id) {
    $card = Card::findOrFail($id);        
    if (Keep::whereUserId(1)->whereCardId($card->id)->exists()){
        return 'true';
    }
    return 'false';
});
Route::get('keep/{id}/keeped', function($id) {
    $existing_keep = Keep::withTrashed()->whereCardId($id)->whereUserId(1)->first();
    $card = Card::find( $id ); 
    if (is_null($existing_keep)) {
        Keep::create([
            'card_id' => $id,
            'user_id' => 1,
            'keepTime' => time(),                                
        ]);                                           
    } else {
        if (is_null($existing_keep->deleted_at)) {
            $existing_keep->delete();                         
        } else {
            $existing_keep->restore();                        
        }
    }
    $card->save();           
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Draw
|--------------------------------------------------------------------------
*/

Route::get('draws', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Draw::all();
});
 
Route::get('draws/{id}', function($id) {
    return Draw::find($id);
});

Route::post('draws', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::put('draws/{id}', function(Request $request, $id) {
    $draw = Draw::findOrFail($id);
    $draw->update($request->all());

    return $draw;
});

Route::delete('draws/{id}', function($id) {
    Draw::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Store
|--------------------------------------------------------------------------
*/
Route::get('stores', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Store::all();
});
 
Route::get('stores/{id}', function($id) {
    return Store::find($id);
});

Route::post('stores', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::put('stores/{id}', function(Request $request, $id) {
    $store = Store::findOrFail($id);
    $store->update($request->all());

    return $store;
});

Route::delete('stores/{id}', function($id) {
    Store::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Notification
|--------------------------------------------------------------------------
*/

Route::get('notifications', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Notification::all();
});
 
Route::get('notifications/{id}', function($id) {
    return Notification::find($id);
});

Route::post('notifications', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::put('notifications/{id}', function(Request $request, $id) {
    $notification = Notification::findOrFail($id);
    $notification->update($request->all());

    return $notification;
});

Route::delete('notifications/{id}', function($id) {
    Notification::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Register
|--------------------------------------------------------------------------
*/
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::post('checkfacebook', function(Request $request) {
    $session_user = App\User::where([['facebook_id', '=',$request->get('hdnFbID')]])->first();
    if ($session_user === null) {
        $strPicture = "https://graph.facebook.com/".$request->get('hdnFbID')."/picture?type=large";
        $strLink = "https://www.facebook.com/app_scoped_user_id/".$request->get('hdnFbID')."/";
        $user = User::create([
            'facebook_id' => $request->get('hdnFbID'),            
            'name' =>$request->get('hdnName'),  
            'detail' => '...',                       
            'email' => $request->get('hdnEmail'),     
            'profile' => $strPicture,                         
            'password' =>0,
            'cards' => 0, 
            'followers' => 0,                                    
            'following' => 0,   
            'notification' => 0,
            'link'=> $strLink,
            'api_token'=> \Session::get('api')               
        ]);
        $session_user = User::where('email', '=',$request->get('hdnEmail'))->first();
        Session::put('user_id',$session_user->id);            
        return redirect('/logined'); 
    }else{
        $session_user = User::where('facebook_id', '=',$request->get('hdnFbID'))->get();       
        $session_user->api_token = \Session::get('api') ;
        $session_user->save();  
        return redirect('/logined'); 
    }
});