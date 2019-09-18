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
use App\Subject;
use App\Post;

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

Route::get('addname/{name}/{api}', function($name,$api) {
    $user = User::create([
        'facebook_id' => 0,            
        'name' =>$name,  
        'detail' => '...',                       
        'email' => 0,     
        'profile' => 'https://sv1.picz.in.th/images/2019/08/02/KXiX3g.png',                         
        'password' =>0,
        'cards' => 0, 
        'followers' => 0,                                    
        'following' => 0,   
        'notification' => 0,
        'link'=> 0,
        'api_token'=> $api              
    ]);
    return $user;
});

Route::post('adduser', function(Request $request) {
    return User::create([
        'facebook_id' => 0,            
        'name' =>$request->name,  
        'detail' => '...',                       
        'email' => 0,     
        'profile' => $request->profile,                         
        'password' =>0,
        'cards' => 0, 
        'followers' => 0,                                    
        'following' => 0,   
        'notification' => 0,
        'link'=> 0,
        'api_token'=> $request->api    
    ]);
    //return  $request->post();
});

Route::get('changeprofile/{profile}/{api}', function($profile,$api) {
    $user = User::where('api_token',$api)->get();
    $upload = User::find($user[0]->id);        
    $upload->profile = $profile;
    $upload->save();
    return $user;
});

Route::get('users/{api}', function($api) {
    $user = User::where('api_token',$api)->get();
    return $user;
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

Route::get('feedcards', function() {
    $cards = Card::with('user')->orderBy('id','desc')->paginate(10);
    if(!empty($cards)) { //New default value is set
        foreach($cards as $value) {
            $update = Card::find($value->id);        
            $update->cardView += 1;
            $update->save();
        }
    }
    return Card::with('user')->orderBy('id','desc')->paginate(10);
});

Route::get('feedusers/{id}', function($id) {
    return Card::with('user')->where('user_id',$id)->orderBy('id','desc')->paginate(10);
});

Route::get('feedprofile', function() {
    return DB::select("SELECT  cards.user_id,users.name,users.profile, MAX(cards.created_at)AS date FROM cards,users where cards.user_id = users.id  GROUP BY user_id order by date DESC limit 10");
   // return Card::join('users', 'cards.user_id', '=', 'users.id')->select('user_id','users.name','users.profile',\DB::raw("(select max(`created_at`) from cards)"))->groupBy('user_id')->take(10)->get();
});
 
Route::get('cards/{id}', function($id) {
    return Card::with('user')->find($id);
});

Route::get('savecard/{id}/{api}', function($id,$api) {
    $user = User::where('api_token',$api)->get();
    $card = Card::with('user')->find($id);
    $card->cardShare += 1;
    $card->save();
    if (Notification::where('user_id', '=', $card->user_id)->where('item_id', '=', $id)->exists()) {
        Notification::where('user_id', '=', $card->user_id)->where('item_id', '=', $id)->first()->delete();
        Notification::create([
            'user_id' => $card->user_id,
            'item_id' => $id,
            'item' => 'มีผู้ดาวน์โหลดการ์ดของคุณ',
            'itemType' => 1,
            'notificationStatus' => 0,
            'notificationTime' => time(),
            'sender' => $user[0]->id,
        ]);
        // user found
    }else{
        Notification::create([
            'user_id' => $card->user_id,
            'item_id' => $id,
            'item' => 'มีผู้ดาวน์โหลดการ์ดของคุณ',
            'itemType' => 1,
            'notificationStatus' => 0,
            'notificationTime' => time(),
            'sender' => $user[0]->id,
        ]);
    }
    $user = User::find($card->user_id);
    $user->following += 1;
    $user->save();
    return 204;
});

Route::get('carduser/{id}', function($id) {
    $user = Card::with('user')->find($id);
    return Card::where('user_id',$user->user_id)->where('id','<>',$id)->take(6)->get();
});

Route::post('cards', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();  
    $upload = User::find($user[0]->id);        
    $upload->cards += 1;
    $upload->save();
    return Card::create([
        'user_id'=> $user[0]->id,
        'card'=> $request->card,
        'cardPhoto'=> $request->cardPhoto,
        'cardBg'=> $request->cardBg,
        'cardView' => 0,
        'cardLike' => 0,
        'cardComment' => 0,
        'cardShare' => 0,
        'cardTime'  => time(),
        'card_ip'=> $request->getClientIp(),
        'cardColor' => $request->cardColor,
        'cardDetail' => 0,
        'subject_id' => 0,
        'post_id' => 0,
        'cardTags' => 0,
        'cardForm' => $request->cardForm,
    ]);
    //return  $request->post();
});
//api demo starts
Route::post('editcard/{id}', function(Request $request,$id) {
    $card = Card::findOrFail($id);
    $card->card = $request->card;
    $card->save();
    return $card;
});

Route::get('deletecard/{id}', function($id) {
    $card = Card::find($id);
    $user = User::find($card->user_id);
    $user->cards -= 1;
    $user->save();
    Card::find($id)->delete();
    return 204;
});
//api demo end

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

Route::get('follow/{id}/isfollowbyme/{api}', function($id,$api) {
    $user = User::findOrFail($id);    
    $useronclick = User::where('api_token',$api)->get();  
    if (Follow::whereUserId($useronclick[0]->id)->where('fuser_id',$user->id)->exists()){
        return 'true';
    }
    return 'false';
});
Route::get('follow/{id}/followed/{api}', function($id,$api) {
    $useronclick = User::where('api_token',$api)->get();  
    $existing_follow = Follow::withTrashed()->where('fuser_id',$id)->whereUserId($useronclick[0]->id)->first();
    $user = User::findOrFail($id);
    $usermember = User::findOrFail($useronclick[0]->id);
    //$user = User::find($card->user_id);        
    if (is_null($existing_follow)) {
        Follow::create([
            'fuser_id' => $id,
            'user_id' => $useronclick[0]->id,             
        ]);
        //$follow->cardLike += 10;
        $user->followers += 1;      
        $usermember->following += 1;        
    } else {
        if (is_null($existing_follow->deleted_at)) {
            $existing_follow->delete();
            //$follow->cardLike -= 10;   
            //$user->power -= 5;    
            $user->followers -= 1;    
            $usermember->following -= 1;       
        } else {
            $existing_follow->restore();
            //$follow->cardLike += 10;
            //$user->power += 5;       
            $user->followers += 1;         
            $usermember->following += 1;         
        }
    }
    //$user->save();        
    $user->save();    
    $usermember->save();     

});

Route::get('feedfollow/{api}', function($api) {
    $user = User::where('api_token',$api)->get();  
    $id = $user[0]->id;  
   return Card::whereIn('user_id', function($query) use ($id){
        $query->select('fuser_id')
        ->from('follows')
        ->where('user_id', $id)->withTrashed();
    })->with('user')->orderBy('id','desc')->paginate(10);
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

Route::get('searchdraws/{text}', function($text) {
    return Draw::where('alt', 'LIKE', '%'.$text.'%')->paginate(30);
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
    return Notification::with('card')->get();
});
 
Route::get('notifications/{id}', function($id) {
    return Notification::find($id);
});

Route::get('shownotification/{api}', function($api) {
    $user = User::where('api_token',$api)->get();  
    return Notification::with('card')->with('sender')->where('user_id',$user[0]->id)->orderBy('id','desc')->take(10)->get();
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

/*
|--------------------------------------------------------------------------
| POST API Routes Subject
|--------------------------------------------------------------------------
*/

Route::get('subjects', function() {
    return Subject::all();
});
 
Route::get('subjects/{id}', function($id) {
    return Subject::with('user')->find($id);
});

Route::get('feedsubjects', function() {
    return Subject::with('user')->orderBy('id','desc')->paginate(10);
});

Route::get('searchsubjects/{text}', function($text) {
    return Subject::with('user')->where('subject', 'LIKE', '%'.$text.'%')->paginate(10);
});

Route::post('subjects', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();  
    return Subject::create([
        'user_id'=> $user[0]->id,
        'subject'=> $request->subject,
        'subjectItem' => 0,
        'subjectLike' => 0,
        'subjectView' => 0,
        'subjectTime'  => time(),
        'subject_ip'=> $request->getClientIp(),
    ]);
    //return  $request->post();
});

Route::put('subjects/{id}', function(Request $request, $id) {
    $subject = Subject::findOrFail($id);
    $subject->update($request->all());

    return $subject;
});

Route::delete('subjects/{id}', function($id) {
    Subject::find($id)->delete();
    return 204;
});

Route::post('postroom', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();  
    $upload = User::find($user[0]->id);        
    $upload->cards += 1;
    $upload->save();
    $subject = Subject::find($request->subject_id);        
    $subject->subjectItem += 1;
    $subject->save();
    return Card::create([
        'user_id'=> $user[0]->id,
        'card'=> $request->card,
        'cardPhoto'=> $request->cardPhoto,
        'cardBg'=> $request->cardBg,
        'cardView' => 0,
        'cardLike' => 0,
        'cardComment' => 0,
        'cardShare' => 0,
        'cardTime'  => time(),
        'card_ip'=> $request->getClientIp(),
        'cardColor' => $request->cardColor,
        'cardDetail' => $request->cardDetail,
        'subject_id' => $request->subject_id,
        'post_id' => 0,
        'cardTags' => 0,
        'cardForm' => $request->cardForm,
    ]);
    //return  $request->post();
});

Route::get('room/{id}', function($id) {
    return Card::with('user')->where('subject_id',$id)->orderBy('id','desc')->paginate(10);
});



/*
|--------------------------------------------------------------------------
| POST API Routes Post
|--------------------------------------------------------------------------
*/

Route::get('posts', function() {
    return Post::all();
});
 
Route::get('post/{id}', function($id) {
    return Post::with('user')->find($id);
});

Route::get('feedposts', function() {
    return Post::with('user')->orderBy('id','desc')->paginate(10);
});

Route::get('searchposts/{text}', function($text) {
    return Post::with('user')->where('post', 'LIKE', '%'.$text.'%')->paginate(10);
});

Route::post('posts', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();  
    return Post::create([
        'user_id'=> $user[0]->id,
        'post'=> $request->post,
        'postPhoto'=> $request->postPhoto,
        'postDetail' => $request->postDetail,
        'postBg'=> $request->postBg,
        'postColor' => $request->postColor,
        'postItem' => 0,
        'postView' => 0,
        'postLike' => 0,
        'postShare' => 0,
        'postComment' => 0,
        'postTime'  => time(),
        'post_ip'=> $request->getClientIp(),
        'postTags' => 0,
    ]);
    //return  $request->post();
});

Route::put('posts/{id}', function(Request $request, $id) {
    $post = Post::findOrFail($id);
    $post->update($request->all());

    return $post;
});

Route::delete('posts/{id}', function($id) {
    Post::find($id)->delete();
    return 204;
});

Route::post('postpost', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();  
    $upload = User::find($user[0]->id);        
    $upload->cards += 1;
    $upload->save();
    $post = Post::find($request->post_id);        
    $post->postItem += 1;
    $post->save();
    return Card::create([
        'user_id'=> $user[0]->id,
        'card'=> $request->card,
        'cardPhoto'=> $request->cardPhoto,
        'cardBg'=> $request->cardBg,
        'cardView' => 0,
        'cardLike' => 0,
        'cardComment' => 0,
        'cardShare' => 0,
        'cardTime'  => time(),
        'card_ip'=> $request->getClientIp(),
        'cardColor' => $request->cardColor,
        'cardDetail' => $request->cardDetail,
        'subject_id' => 0,
        'post_id' => $request->post_id,
        'cardTags' => 0,
        'cardForm' => $request->cardForm,
    ]);
    //return  $request->post();
});

Route::get('content/{id}', function($id) {
    return Card::with('user')->where('post_id',$id)->paginate(10);
});