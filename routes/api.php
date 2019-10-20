<?php
use Illuminate\Support\Facades\Input as Input;
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
use App\Good;
use App\Merit;
use App\Boon;
use App\Join;
use App\Admire;


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

Route::get('addname/{name}/{api}/{status}/{status_id}', function($name,$api,$status,$status_id) {
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
        'downloading' => 0,
        'boons' => 0,
        'status' => $status,
        'status_id' => $status_id,
        'ranking' => 0,
        'link'=> 0,
        'api_token'=> $api              
    ]);
    return $user;
});
Route::get('checkfbuser/{id}/{api}', function($id,$api) {
    if (User::where('facebook_id', '=', $id)->exists()) {
        $user = User::where('facebook_id', $id)->first();
        $upload = User::find($user->id);        
        $upload->api_token = $api;
        $upload->save();
        return $user;
    }else{
        return 'false';
    }
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
        'downloading' => 0,
        'boons' => 0,
        'status' => $request->status,
        'status_id' => $request->status_id,
        'ranking' => 0,
        'link'=> 0,
        'api_token'=> $request->api    ,
        'joiner'=> 0,
        'joining'=> 0,
        'watyear'=> 0,
        'online'=> 0,
    ]);
    //return  $request->post();
});


Route::post('addfbuser', function(Request $request) {
    if (User::where('facebook_id', '=', $request->id)->exists()) {
        $user = User::where('facebook_id', $request->id)->first();
        $upload = User::find($user->id);        
        $upload->api_token = $request->api;
        $upload->save();
        return $user;
    }else{
        return User::create([
            'facebook_id' => $request->id,            
            'name' =>$request->name,  
            'detail' => '...',                       
            'email' => 0,     
            'profile' => $request->profile,                         
            'password' =>0,
            'cards' => 0, 
            'followers' => 0,                                    
            'following' => 0,   
            'notification' => 0,
            'downloading' => 0,
            'boons' => 0,
            'status' => $request->status,
            'status_id' => $request->status_id,
            'ranking' => 0,
            'link'=> 0,
            'api_token'=> $request->api ,
            'joiner'=> 0,
            'joining'=> 0,
            'watyear'=> 0,
            'online'=> 0,
        ]);
    }
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

Route::get('user/{id}', function($id) {
    $user = User::find($id);
    return $user;
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

Route::get('feedusermerit', function() {
    return User::with('merit')->orderBy('joining','desc')->paginate(10);;
});

/*
|--------------------------------------------------------------------------
| POST API Routes Card
|--------------------------------------------------------------------------
*/
Route::get('cards', function() {
    return Card::all();
});

Route::get('checkcard/{id}/{api}', function($id,$api) {
    $useronclick = User::where('api_token',$api)->get();  
    if (Card::where('id',$id)->where('user_id',$useronclick[0]->id)->exists()){
        return 'true';
    }
    return 'false';
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
    return Card::with('user')->with('post')->orderBy('id','desc')->paginate(10);
});

Route::get('feedusers/{id}', function($id) {
    return Card::with('user')->where('user_id',$id)->orderBy('id','desc')->paginate(10);
});

Route::get('cardcard/{id}', function($id) {
    return Card::with('user')->with('post')->where('id','<=',$id)->orderBy('id','desc')->paginate(10);
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
    $user->notification += 1;
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

Route::get('searchcards/{text}', function($text) {
    return Card::with('user')->where('card', 'LIKE', '%'.$text.'%')->paginate(10);
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
        ->where('user_id', $id)->where('deleted_at', null);
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

Route::get('like/{id}/liked/{api}', function($id,$api) {
    $useronclick = User::where('api_token',$api)->get();  
    $existing_like = Like::withTrashed()->whereCardId($id)->whereUserId($useronclick[0]->id)->where('likeType',1)->first();
    $card = Card::find( $id );
    if (is_null($existing_like)) {
        Like::create([
            'card_id' => $id,
            'user_id' => $useronclick[0]->id,
            'likeType' => 1,                                
        ]);
        $card->cardLike += 1;
        if (Notification::where('user_id', '=', $card->user_id)->where('itemType', '=', 2)->where('item_id', '=', $id)->exists()) {
            Notification::where('user_id', '=', $card->user_id)->where('itemType', '=', 2)->where('item_id', '=', $id)->first()->delete();
            Notification::create([
                'user_id' => $card->user_id,
                'item_id' => $id,
                'item' => 'กดชอบการ์ดของคุณ',
                'itemType' => 2,
                'notificationStatus' => 0,
                'notificationTime' => time(),
                'sender' => $useronclick[0]->id,
            ]);
            // user found
        }else{
            Notification::create([
                'user_id' => $card->user_id,
                'item_id' => $id,
                'item' => 'กดชอบการ์ดของคุณ',
                'itemType' => 2,
                'notificationStatus' => 0,
                'notificationTime' => time(),
                'sender' => $useronclick[0]->id,
            ]);
        }
        $user = User::find($card->user_id);        
        $user->notification += 1;
        $user->save();
        //$user->power += 5;                                             
    } else {
        
        $card->cardLike += 1;
        /*
        if (is_null($existing_like->deleted_at)) {
            $existing_like->delete();
            $card->cardLike -= 1;   
            //$user->power -= 5;                                 
        } else {
            $existing_like->restore();
            $card->cardLike += 1;
            //$user->power += 5;                                 
        }
        */
    }
    //$user->save();        
    $card->save();           
});


Route::get('like/{id}/bliked/{api}', function($id,$api) {
    $useronclick = User::where('api_token',$api)->get();  
    $existing_boon = Like::withTrashed()->whereCardId($id)->whereUserId($useronclick[0]->id)->where('likeType',2)->first();
    $boon = Boon::find( $id );
    $merit =Merit::where('good_id','=',$boon->good_id)->where('user_id','=',$boon->user_id)->first();
    if (is_null($existing_boon)) {
        Like::create([
            'card_id' => $id,
            'user_id' => $useronclick[0]->id,
            'likeType' => 2,                                
        ]);
        $boon->boonLike += 1;
        $merit->meritLike += 1;
        if (Notification::where('user_id', '=', $boon->user_id)->where('item_id', '=', $id)->where('itemType', '=', 3)->exists()) {
            Notification::where('user_id', '=', $boon->user_id)->where('item_id', '=', $id)->where('itemType', '=', 3)->first()->delete();
            Notification::create([
                'user_id' => $boon->user_id,
                'item_id' => $id,
                'item' => 'กดอนุโมทนาบุญของคุณ',
                'itemType' => 3,
                'notificationStatus' => 0,
                'notificationTime' => time(),
                'sender' => $useronclick[0]->id,
            ]);
            // user found
        }else{
            Notification::create([
                'user_id' => $boon->user_id,
                'item_id' => $id,
                'item' => 'กดอนุโมทนาบุญของคุณ',
                'itemType' => 3,
                'notificationStatus' => 0,
                'notificationTime' => time(),
                'sender' => $useronclick[0]->id,
            ]);
        }
        $user = User::find($boon->user_id);        
        $user->notification += 1;
        $user->save();
        //$user->power += 5;                                             
    } else {
        
        $boon->boonLike += 1;
        $merit->meritLike += 1;
        /*
        if (is_null($existing_like->deleted_at)) {
            $existing_like->delete();
            $card->cardLike -= 1;   
            //$user->power -= 5;                                 
        } else {
            $existing_like->restore();
            $card->cardLike += 1;
            //$user->power += 5;                                 
        }
        */
    }
    //$user->save();        
    $boon->save();     
    $merit->save();      
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
    return Draw::where('alt', 'LIKE', '%'.$text.'%')->orderBy('id','desc')->paginate(30);
});

Route::get('drawboon/{api}/{id}', function($api,$id) {
    $user = User::where('api_token',$api)->get();  
    return Draw::with('good')->where('status_id',$user[0]->status_id)->where('good_id',$id)->orderBy('id','desc')->paginate(30);
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
    return Notification::with('boon')->with('sender')->where('itemType',3)->where('user_id',$user[0]->id)->orderBy('id','desc')->take(10)->get();
});

Route::get('donotification/{api}', function($api) {
    $user = User::where('api_token',$api)->get();  
    return Notification::with('sender')->where('user_id',$user[0]->id)->orderBy('id','desc')->take(10)->get();
});

Route::get('checknotification/{api}', function($api) {
    $user = User::where('api_token',$api)->get();  
    return $user[0]->notification;
});

Route::get('clearnotification/{api}', function($api) {
    $user = User::where('api_token',$api)->get();  
    $update = User::find($user[0]->id);
    $update->notification = 0;
    $update->save();
    return $user[0]->notification;
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
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Good
|--------------------------------------------------------------------------
*/
Route::get('goods', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Good::all();
});
 
Route::get('goods/{id}', function($id) {
    return Good::find($id);
});

Route::post('goods', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::put('goods/{id}', function(Request $request, $id) {
    $good = Good::findOrFail($id);
    $good->update($request->all());

    return $good;
});

Route::delete('goods/{id}', function($id) {
    Good::find($id)->delete();
    return 204;
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Merit
|--------------------------------------------------------------------------
*/
Route::get('merits', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Merit::all();
});
 
Route::get('merits/{id}', function($id) {
    return Merit::find($id);
});

Route::get('merituser/{id}', function($id) {
    return Merit::with('user')->with('good')->where('user_id',$id)->get();
});

Route::get('meritrankitem/{id}', function($id) {
    return Merit::with('user')->with('good')->where('good_id',$id)->orderBy('meritItem','desc')->paginate(10);
});

Route::get('meritranklike/{id}', function($id) {
    return Merit::with('user')->with('good')->where('good_id',$id)->orderBy('meritLike','desc')->paginate(10);
});

Route::post('merits', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::put('merits/{id}', function(Request $request, $id) {
    $merit = Merit::findOrFail($id);
    $merit->update($request->all());

    return $merit;
});

Route::delete('merits/{id}', function($id) {
    Merit::find($id)->delete();
    return 204;
});

Route::get('onemerititem/{start}/{end}', function($start,$end) {
    return Merit::with('user')->where('meritTime','>',$start)->where('meritTime','<=',$end)->orderBy('meritItem','desc')->first();
});

Route::get('onemeritlike/{start}/{end}', function($start,$end) {
    return Merit::with('user')->where('meritTime','>',$start)->where('meritTime','<=',$end)->orderBy('meritLike','desc')->first();
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Boon
|--------------------------------------------------------------------------
*/
Route::get('boons', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Boon::all();
});

Route::get('feedboons', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Boon::with('user')->with('good')->with('join')->with('like')->orderBy('id','desc')->paginate(10);
});
 
Route::get('feedboongoodid/{id}', function($id) {
    return Boon::with('user')->with('good')->with('like')->where('good_id',$id)->orderBy('id','desc')->paginate(10);
});

Route::get('feedboonuser/{id}/{user_id}', function($id,$user_id) {
    return Boon::with('like')->where('good_id',$id)->where('user_id',$user_id)->orderBy('id','desc')->paginate(10);
});

Route::get('boons/{id}', function($id) {
    return Boon::with('good')->with('user')->find($id);
});

Route::post('boons', function(Request $request) {

    $userget = User::where('api_token',$request->api)->get();  

    $existing_merit = Merit::where('good_id',$request->good_id)->where('user_id',$userget[0]->id)->first();
    if (is_null($existing_merit)) {
        Merit::create([
            'user_id'=> $userget[0]->id,
            'good_id'=> $request->good_id,
            'status_id'=> $userget[0]->status_id,
            'meritItem' => 1,
            'meritLike'=> 0,
            'meritTime'  => time(),
        ]);
        
    }else{
        $merit = Merit::find($existing_merit->id);
        $merit->meritItem += 1;
        $merit->meritTime = time();
        $merit->save();
    }
    $user = User::find($userget[0]->id);        
    $user->boons += 1;
    $user->save();


    return Boon::create([
        'user_id'=> $userget[0]->id,
        'good_id'=> $request->good_id,
        'boon'=> $request->boon,
        'boonPhoto' => $request->boonPhoto,
        'boonDetail'=> 0,
        'boonBg' => '#fff',
        'boonColor' => '#000',
        'boonForm' => 0,
        'boonLike' => 0,
        'boonComment' => 0,
        'boonView' => 0,
        'boonShare' => 0,
        'boonTime'  => time(),
        'boon_ip'=> $request->getClientIp(),
        'boonTags' => 0,
        'boonJoin'=> 0,
    ]);
});

Route::put('boons/{id}', function(Request $request, $id) {
    $boon = Boon::findOrFail($id);
    $boon->update($request->all());

    return $boon;
});

Route::delete('boons/{id}', function($id) {
    Boon::find($id)->delete();
    return 204;
});

/*
|--------------------------------------------------------------------------
| GET DATA API Routes Join
|--------------------------------------------------------------------------
*/
Route::get('joins', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Join::all();
});
 
Route::get('joins/{id}', function($id) {
    return Join::find($id);
});

Route::post('joins', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();
    $update = User::find($user[0]->id);
    $update->boons += 1;
    $update->joining += 1;
    $update->save();

    $boon = Boon::find($request->boon_id);
    $boon->boonJoin += 1;
    $boon->save();

    $uboon = User::find($boon->user_id);
    $uboon->boons +=1;
    $uboon->joiner +=1;
    $uboon->save();

    $existing_merit = Merit::where('good_id',$request->good_id)->where('user_id',$user[0]->id)->first();
    if (is_null($existing_merit)) {
        Merit::create([
            'user_id'=> $user[0]->id,
            'good_id'=> $request->good_id,
            'status_id'=> $user[0]->status_id,
            'meritItem' => 1,
            'meritLike'=> 0,
            'meritTime'  => time(),
        ]);
        
    }else{
        $merit = Merit::find($existing_merit->id);
        $merit->meritItem += 1;
        $merit->meritTime = time();
        $merit->save();
    }


    $uexisting_merit = Merit::where('good_id',$request->good_id)->where('user_id',$uboon->id)->first();
    if (is_null($uexisting_merit)) {
        Merit::create([
            'user_id'=> $uboon->id,
            'good_id'=> $request->good_id,
            'status_id'=> $uboon->status_id,
            'meritItem' => 1,
            'meritLike'=> 0,
            'meritTime'  => time(),
        ]);
        
    }else{
        $umerit = Merit::find($uexisting_merit->id);
        $umerit->meritItem += 1;
        $umerit->meritTime = time();
        $umerit->save();
    }


    if (Notification::where('user_id', '=', $uboon->id)->where('item_id', '=', $request->boon_id)->where('itemType', '=', 4)->exists()) {
        Notification::where('user_id', '=', $uboon->id)->where('item_id', '=', $request->boon_id)->where('itemType', '=', 4)->first()->delete();
        Notification::create([
            'user_id' => $uboon->id,
            'item_id' => $request->boon_id,
            'item' => $request->join,
            'itemType' => 4,
            'notificationStatus' => 1,
            'notificationTime' => time(),
            'sender' => $user[0]->id,
        ]);
        // user found
    }else{
        Notification::create([
            'user_id' => $uboon->id,
            'item_id' => $request->boon_id,
            'item' => $request->join,
            'itemType' => 4,
            'notificationStatus' => 1,
            'notificationTime' => time(),
            'sender' => $user[0]->id,
        ]);
    }

    //return User::create($request->all);
    //return  $request->post();
    return Join::create([
        'boon_id'=> $request->boon_id,
        'good_id'=> $request->good_id,
        'user_id'=> $update->id,
        'join'=> $request->join,
        'joinType'=> 1,
        'joinTime'=>time(),
    ]);
});

Route::put('joins/{id}', function(Request $request, $id) {
    $join = Join::findOrFail($id);
    $join->update($request->all());

    return $join;
});

Route::delete('joins/{id}', function($id) {
    Join::find($id)->delete();
    return 204;
});

Route::get('feedjoin/{id}', function($id) {
    return Join::with('user')->orderBy('id','desc')->where('boon_id',$id)->paginate(10);;
});
/*
|--------------------------------------------------------------------------
| POST API Routes Admire
|--------------------------------------------------------------------------
*/

Route::get('admires', function() {
    return Admire::all();
});
 
Route::get('admires/{id}', function($id) {
    return Admire::find($id);
});

Route::post('admires', function(Request $request) {
    //return Card::create($request->all);
    $user = User::where('api_token',$request->api)->get();
    Notification::create([
        'user_id' => $request->user_id,
        'item_id' => $request->user_id,
        'item' => $request->admire,
        'itemType' => 5,
        'notificationStatus' => 1,
        'notificationTime' => time(),
        'sender' => $user[0]->id,
    ]);
    return  Admire::create([
        'user_id'=> $request->user_id,
        'sender_id'=> $user[0]->id,
        'votes'=> 1,
        'admire'=> $request->admire,
        'admireTime'=> time(),
    ]);
});

Route::put('admires/{id}', function(Request $request, $id) {
    $admire = Admire::findOrFail($id);
    $admire->update($request->all());
    return $admire;
});

Route::delete('admires/{id}', function($id) {
    Admire::find($id)->delete();
    return 204;
});

Route::get('feedadmire/{id}', function($id) {
    return Admire::with('user')->orderBy('id','desc')->where('user_id',$id)->paginate(10);;
});


Route::post('uploadphoto', function(Request $request) {
        if(Input::hasFile('image')){
            $file = Input::file('image');
            $time = time().".png";
            //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
            $file->move('photos/', $file->getClientOriginalName());
            rename('photos/'.$file->getClientOriginalName(),'photos/'.$time);
            return $time;
        }else{
            return 'error';
        }
         /*  $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name= time().'.jpg';
        $path = public_path() . "/photos/" . $image_name;


        //file_put_contents($path, $data);

     
        $photo = new Photo(
        [
            'boon_id'=>$request->get('boon_id'),
            'photo'=>'/'.'photos/'.$image_name
        ]
        );
        $photo->save();
        return response()->json(['id'=>$photo->id]);
        */
});

Route::post('uploadprofile/{api}', function(Request $request,$api) {
    if(Input::hasFile('image')){
        $file = Input::file('image');
        $time = time().".png";
        //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
        $file->move('profile/', $file->getClientOriginalName());
        rename('profile/'.$file->getClientOriginalName(),'profile/'.$time);
        $user = User::where('api_token',$api)->get();  
        $saveprofile = User::find($user[0]->id);
        $saveprofile->profile = $time;
        $saveprofile->save();
        return $time;
    }else{
        return 'error';
    }
});
