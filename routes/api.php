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
use App\Room;
use App\Locat;
use App\Photo;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
//use FCM;
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
        'api_token'=> $api,
        'token'=> 0,        
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
        'token'=> 0,
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
            'token'=> 0,
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

Route::get('changedetail/{detail}/{api}', function($detail,$api) {
    $user = User::where('api_token',$api)->get();
    $upload = User::find($user[0]->id);        
    $upload->detail = $detail;
    $upload->save();
    return $user;
});

Route::get('users/{api}', function($api) {
    $user = User::where('api_token',$api)->get();
    return $user;
});

Route::get('updateonline/{api}', function($api) {
    $update = User::where('api_token',$api)->get();
    $user = User::find($update[0]->id);
    $user->online = time();
    $user->save();
    return $user;
});

Route::get('searchname/{text}', function($text) {
    return User::where('name', 'LIKE', '%'.$text.'%')->paginate(10);
});

Route::get('showuser/{id}', function($id) {
    $user = User::find($id);
    return $user;
});

Route::post('users', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::post('savetokenuser', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();
    $upload = User::find($user[0]->id);        
    $upload->token = $request->token;
    $upload->save();
    return  $upload;
});

Route::get('user/{id}/{api}', function($id,$api) {
    
    $viewer = User::where('api_token',$api)->get();
    if($viewer[0]->id != $id){
        if (Notification::where('user_id', '=', $id)->where('sender', '=',$viewer[0]->id)->where('item', '=','เข้ามาดูโปรไฟล์ของคุณ')->where('itemType', '=', 6)->exists()) {
            Notification::where('user_id', '=', $id)->where('sender', '=',$viewer[0]->id)->where('item', '=','เข้ามาดูโปรไฟล์ของคุณ')->where('itemType', '=', 6)->first()->delete();
            Notification::create([
                'user_id' => $id,
                'item_id' => 0,
                'item' => 'เข้ามาดูโปรไฟล์ของคุณ',
                'itemType' => 6,
                'notificationStatus' => 1,
                'notificationTime' => time(),
                'sender' => $viewer[0]->id,
            ]);
            // user found
            $user = User::find($id);
        }else{
        Notification::create([
                    'user_id' => $id,
                    'item_id' => 0,
                    'item' => 'เข้ามาดูโปรไฟล์ของคุณ',
                    'itemType' => 6,
                    'notificationStatus' => 1,
                    'notificationTime' => time(),
                    'sender' => $viewer[0]->id,
                ]);
            $user = User::find($id);
        }
        /*
        if(strlen($user->token) > 1){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);
        
            $notificationBuilder = new PayloadNotificationBuilder($viewer[0]->name);
            $notificationBuilder->setBody('เข้ามาดูโปรไฟล์ของคุณ')
                                ->setSound('default');
        
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);
        
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $downstreamResponse = FCM::sendTo($user->token, $option, $notification, $data);
        
            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
            $downstreamResponse->tokensToDelete();
            $downstreamResponse->tokensToModify();
            $downstreamResponse->tokensToRetry();
            $downstreamResponse->tokensWithError();
        }*/
    }else{
        $user = User::find($id);
    }
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

Route::get('introfollow', function() {
    return User::orderBy('followers','desc')->paginate(10);;
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
        if(strlen($user->token) > 1){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);
        
            $notificationBuilder = new PayloadNotificationBuilder($usermember->name);
            $notificationBuilder->setBody('ติดตามการทำบุญของคุณ')
                                ->setSound('default');
        
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);
        
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $downstreamResponse = FCM::sendTo($user->token, $option, $notification, $data);
        
            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
            $downstreamResponse->tokensToDelete();
            $downstreamResponse->tokensToModify();
            $downstreamResponse->tokensToRetry();
            $downstreamResponse->tokensWithError();
        } 
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

Route::get('boonfollow/{api}', function($api) {
    $user = User::where('api_token',$api)->get();  
    $id = $user[0]->id;  

   return Boon::whereIn('user_id', function($query) use ($id){
        $query->select('fuser_id')
        ->from('follows')
        ->where('user_id', $id)->where('deleted_at', null);
    })->with('user')->with('good')->orderBy('id','desc')->paginate(10);
});

Route::get('isfollow/{api}', function($api) {
    $user = User::where('api_token',$api)->get();  
    $id = $user[0]->id;  
    $results = Follow::where('fuser_id',$id)->get();
    foreach ($results as $result){ 
        $fuser = User::find($result->user_id);
        if(strlen($fuser->token) > 1){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);
        
            $notificationBuilder = new PayloadNotificationBuilder($user[0]->name);
            $notificationBuilder->setBody('กำลังทำบุญ ณ ที่ใดที่หนึ่ง')
                                ->setSound('default');
        
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);
        
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $downstreamResponse = FCM::sendTo($fuser->token, $option, $notification, $data);
        
            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
            $downstreamResponse->tokensToDelete();
            $downstreamResponse->tokensToModify();
            $downstreamResponse->tokensToRetry();
            $downstreamResponse->tokensWithError();
        }
    }

   return Follow::where('user_id',$id)->get();
});

Route::get('showfollowing/{id}', function($id) {
    $user = User::find( $id );  
    $id = $user->id;  
   return Follow::where('user_id',$id)->with('fuser')->paginate(10);
});

Route::get('showfriends/{api}', function($api) {
    $update = User::where('api_token',$api)->get();
    $user = User::find( $update[0]->id);  
    $id = $user->id;  
   return Follow::where('user_id',$id)->with('fuser')->paginate(10);
});

Route::get('showfollower/{id}', function($id) {
    $user = User::find( $id );  
    $id = $user->id;  
   return Follow::where('fuser_id',$id)->with('user')->paginate(10);
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
            $user = User::find($boon->user_id); 
            if(strlen($user->token) > 1){
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60*20);
            
                $notificationBuilder = new PayloadNotificationBuilder($useronclick[0]->name);
                $notificationBuilder->setBody('กดอนุโมทนาบุญของคุณ')
                                    ->setSound('default');
            
                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['a_data' => 'my_data']);
            
                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data = $dataBuilder->build();
                $downstreamResponse = FCM::sendTo($user->token, $option, $notification, $data);
            
                $downstreamResponse->numberSuccess();
                $downstreamResponse->numberFailure();
                $downstreamResponse->numberModification();
                $downstreamResponse->tokensToDelete();
                $downstreamResponse->tokensToModify();
                $downstreamResponse->tokensToRetry();
                $downstreamResponse->tokensWithError();
            }
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

Route::post('postdhamma', function(Request $request) {
    return Card::create([
        'user_id'=> 1,
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
        'post_id' => 1,
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

Route::get('feedlocatgoods/{id}', function($id) {
    return Good::where('locat_id',$id)->latest('goodItem')->get();
});

Route::get('feedgoods', function() {
    return Good::with('boon')->get()->map(function ($query) {
        $query->setRelation('boon', $query->boon->take(3));
        return $query;
    });
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

Route::get('gooddistance/{lat}/{lng}', function($lat,$lng) {
    $sqlDistance = DB::raw('( 6371 * acos( cos( radians(' . $lat . ') ) 
       * cos( radians( goodLatitude ) ) 
       * cos( radians( goodLongitude ) 
       - radians(' . $lng  . ') ) 
       + sin( radians(' . $lat  . ') ) 
       * sin( radians( goodLatitude ) ) ) )');
    return DB::table('goods')
    ->select('*')
    ->selectRaw("{$sqlDistance} AS distance")
    ->orderBy('distance')
    ->paginate(4);
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
 
Route::get('feedboonphotos', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Boon::with('user')->with('good')->with('join')->with('like')->where('boonPhoto','!=','0')->orderBy('id','desc')->paginate(10);
});

Route::get('feedboontop', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Boon::with('user')->with('good')->with('join')->with('like')->where('boonJoin','!=',0)->orderBy('boonJoin','desc')->paginate(10);
});

Route::get('feedboonuser/{id}/{user_id}', function($id,$user_id) {
    return Boon::with('user')->with('like')->where('good_id',$id)->where('user_id',$user_id)->orderBy('id','desc')->paginate(10);
});

Route::get('boons/{id}', function($id) {
    return Boon::with('good')->with('user')->find($id);
});

Route::get('groupboon', function() {
    //return Boon::with('good')->with('user')->groupBy('user_id')->paginate(10);
    /*return DB::table('boons')
             ->select('*')
             ->groupBy('user_id')->pluck('user_id')->paginate(10);*/
    return        DB::table('boons')
                 ->select('user_id as id', DB::raw('max(boonTime) as boonTime'),'users.name','users.profile','users.detail','users.followers','users.following')
                 ->join('users','user_id','=','users.id')
                 ->groupBy('user_id')->orderBy('boonTime','desc')
                 ->paginate(10);
    //return   Boon::paginate(10)->groupBy('user_id');
});

Route::get('lastboon', function() {
    return Boon::latest('id')->first();
});

Route::get('lastboonphoto', function() {
    return Boon::latest('id')->where('boonPhoto','!=','0')->first();
});

Route::get('lastboontop', function() {
    return Boon::latest('boonJoin')->where('boonJoin','!=',0)->first();
});

Route::get('boonuser/{user_id}', function($user_id) {
    return Boon::with('user')->with('good')->with('join')->with('like')->where('user_id',$user_id)->orderBy('id','desc')->paginate(10);
});
//*********************** GOOD_ID  ***********************************/
Route::get('lastboon_goodid/{id}', function($id)  {
    return Boon::latest('id')->where('good_id',$id)->first();
});

Route::get('lastboonphoto_goodid/{id}', function($id)  {
    return Boon::latest('id')->where('good_id',$id)->where('boonPhoto','!=','0')->first();
});

Route::get('lastboontop_goodid/{id}', function($id)  {
    return Boon::latest('boonJoin')->where('good_id',$id)->where('boonJoin','!=',0)->first();
});

Route::get('feedboon_goodid/{id}', function($id) {
    return Boon::with('user')->with('good')->with('like')->where('good_id',$id)->orderBy('id','desc')->paginate(10);
});

Route::get('feedboonlike_goodid/{id}', function($id) {
    return Boon::with('user')->with('good')->with('like')->where('good_id',$id)->orderBy('boonJoin','desc')->paginate(10);
});

Route::get('feedboongoodidphotos_goodid/{id}', function($id) {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Boon::with('user')->with('good')->with('join')->with('like')->where('boonPhoto','!=','0')->where('good_id',$id)->orderBy('id','desc')->paginate(10);
});
Route::get('searchboons/{text}', function($text) {
    return Boon::with('user')->with('good')->with('join')->with('like')->where('boon', 'LIKE', '%'.$text.'%')->orderBy('id','desc')->paginate(10);
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
        $ToBoonView = $merit->meritItem;
        $merit->meritTime = time();
        $merit->save();
    }
    $user = User::find($userget[0]->id);        
    $user->boons += 1;
    $user->save();

    $good = Good::find($request->good_id); 
    $good->goodItem += 1;
    $good->save();

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
        'boonView' => $ToBoonView,
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

Route::get('boonweek/{user_id}/{start}/{end}', function($user_id,$start,$end) {
    return Boon::where('user_id',$user_id)->where('boonTime','>',$start)->where('boonTime','<=',$end)->orderBy('boonTime','desc')->count();
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
        if(strlen($uboon->token) > 1){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);
        
            $notificationBuilder = new PayloadNotificationBuilder($user[0]->name);
            $notificationBuilder->setBody('ร่วมจอยบุญกับคุณ')
                                ->setSound('default');
        
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);
        
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $downstreamResponse = FCM::sendTo($uboon->token, $option, $notification, $data);
        
            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();
            $downstreamResponse->tokensToDelete();
            $downstreamResponse->tokensToModify();
            $downstreamResponse->tokensToRetry();
            $downstreamResponse->tokensWithError();
        }
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
Route::get('userjoin/{id}', function($id) {
    return Join::whereIn('boon_id', function($query) use ($id){
        $query->select('boon_id')
        ->from('boons')
        ->where('user_id', $id);
    })->with('user')->with('boon')->orderBy('id','desc')->paginate(10);
    //return Join::with('user')->with('boon')->orderBy('id','desc')->where('user_id',$id)->paginate(10);
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
    $touser = User::find($request->user_id);
    if(strlen($touser->token) > 1){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
    
        $notificationBuilder = new PayloadNotificationBuilder($user[0]->name);
        $notificationBuilder->setBody($request->admire)
                            ->setSound('default');
    
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);
    
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($touser->token, $option, $notification, $data);
    
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        $downstreamResponse->tokensToDelete();
        $downstreamResponse->tokensToModify();
        $downstreamResponse->tokensToRetry();
        $downstreamResponse->tokensWithError();
    }
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

Route::get('feedadmire/{id}/{api}', function($id,$api) {
    $sender = User::where('api_token',$api)->get();
    return Admire::with('user')->orderBy('id','desc')
    ->where('user_id',$id)
    ->where('sender_id',$sender[0]->id)
    ->paginate(10);
});

Route::get('useradmire/{api}', function($api) {
    $user = User::where('api_token',$api)->get();
    return Admire::with('user')->orderBy('id','desc')->where('user_id',$user[0]->id)->paginate(10);;
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
        $saveprofile->profile = 'https://jaipun.com/profile/'.$time;
        $saveprofile->save();
        return $time;
    }else{
        return 'error';
    }
});



Route::get('fcmtest', function() {
    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder('my title');
    $notificationBuilder->setBody('Hello world')
                        ->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData(['a_data' => 'my_data']);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();
    //android
    //$token = "eJN2WRYJP4k:APA91bGrjsht9ga_ef4VcK9LA3QoYTbxpLZG5xCdsWZ0b2J4I-pVqraYVrMOOLajVawRQXiMXghTQJRJJbeR8g_TZaBhJQOIE23BDqj7QVCIXuF02EywRBAIFjfU7g18EFh2pdfZByia";
    //iOS
    $token = "eotKYVOUog0:APA91bHtEL4KDYhvQUqiYjzYXHsNPbxehml2_AUPHwS63-zN0kN6D-RMYDS_0_HuojqiSpL480TQmAgLnGOA40BwQuLsZk7V-Si01-IV7Kd6h4iUQpNp0mIMzwwtfrK8op_uRLnobLc6";
    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

    $downstreamResponse->numberSuccess();
    $downstreamResponse->numberFailure();
    $downstreamResponse->numberModification();

    // return Array - you must remove all this tokens in your database
    $downstreamResponse->tokensToDelete();

    // return Array (key : oldToken, value : new token - you must change the token in your database)
    $downstreamResponse->tokensToModify();

    // return Array - you should try to resend the message to the tokens in the array
    $downstreamResponse->tokensToRetry();

    // return Array (key:token, value:error) - in production you should remove from your database the tokens
    $downstreamResponse->tokensWithError();
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Room
|--------------------------------------------------------------------------
*/
Route::get('rooms', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Room::all();
});
 
Route::get('rooms/{id}', function($id) {
    return Room::find($id);
});

Route::get('feedroom/{id}', function($id) {
    return Room::with('user')->orderBy('id','desc')->where('good_id',$id)->paginate(10);;
});

Route::get('lastroom/{good_id}', function($good_id) {
    return Room::latest('id')->where('good_id',$good_id)->first();
});

Route::get('updateroom/{id}/{good_id}', function($id,$good_id) {
    return Room::with('user')->orderBy('id','desc')->where('id','>',$id)->where('good_id',$good_id)->paginate(10);;
});

Route::post('rooms', function(Request $request) {
    $user = User::where('api_token',$request->api)->get();  
    $update = User::find($user[0]->id);   
    return Room::create([
        'user_id'=> $update->id,
        'good_id'=> $request->good_id,
        'room'=> $request->room,
        'roomLike'=> 0,
        'roomType'=> 1,
        'roomTime'=>time(),
    ]);
    //return  $request->post();
});

Route::put('rooms/{id}', function(Request $request, $id) {
    $room = Room::findOrFail($id);
    $room->update($request->all());
    return $room;
});

Route::delete('rooms/{id}', function($id) {
    Room::find($id)->delete();
    return 204;
});

/*
|--------------------------------------------------------------------------
| GET DATA API Routes Locat
|--------------------------------------------------------------------------
*/
Route::get('locats', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Locat::all();
});
 
Route::get('locats/{id}', function($id) {
    return Locat::find($id);
});

Route::post('locats', function(Request $request) {
    //return User::create($request->all);
    return  $request->post();
});

Route::put('locats/{id}', function(Request $request, $id) {
    $locat = Locat::findOrFail($id);
    $locat->update($request->all());

    return $locat;
});

Route::delete('locats/{id}', function($id) {
    Locat::find($id)->delete();
    return 204;
});

Route::get('locatdistance/{lat}/{lng}', function($lat,$lng) {
    $sqlDistance = DB::raw('( 6371 * acos( cos( radians(' . $lat . ') ) 
       * cos( radians( locatLatitude ) ) 
       * cos( radians( locatLongitude ) 
       - radians(' . $lng  . ') ) 
       + sin( radians(' . $lat  . ') ) 
       * sin( radians( locatLatitude ) ) ) )');
    return DB::table('locats')
    ->select('*')
    ->selectRaw("{$sqlDistance} AS distance")
    ->orderBy('distance')
    ->paginate(4);
});
/*
|--------------------------------------------------------------------------
| GET DATA API Routes Photo
|--------------------------------------------------------------------------
*/
Route::get('photos', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Photo::all();
});
 
Route::get('photos/{id}', function($id) {
    return Photo::find($id);
});

Route::post('photos', function(Request $request) {
    /*$results = $request->photos;
    foreach ($results as $result){ 
        echo $result;
    }*/
    //return User::create($request->all);
    return  $request->photos();
});

Route::put('photos/{id}', function(Request $request, $id) {
    $photo = Photo::findOrFail($id);
    $photo->update($request->all());

    return $photo;
});

Route::delete('photos/{id}', function($id) {
    Photo::find($id)->delete();
    return 204;
});

