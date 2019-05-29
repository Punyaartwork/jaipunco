<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/top', function () {
    $types = App\Type::all();
    return view('feed.top',compact('types'));
});

Route::get('/', function () {
    $tags = App\Tag::with('user')->with('type')->take(3)->orderBy('tagVotes','desc')->get();
    $tops =  App\Post::with('user')->with('tag')->orderBy('postLike','desc')->take(6)->get();
    $shares =  App\Post::with('user')->with('tag')->orderBy('postShare','desc')->take(6)->get();
    $news =  App\Post::with('user')->with('tag')->orderBy('id','desc')->take(6)->get();    
    return view('feed.home',compact('tags','tops','shares','news'));
});

Route::get('/list', function () {
    return view('feed.list');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('user','UserController');
Route::group(['middleware' => 'usersession'], function () {
    Route::resource('type','TypeController');
    Route::resource('tag','TagController');
    Route::resource('drawname','DrawnameController');
    Route::resource('img','DrawController');
    Route::resource('post','PostController');
    Route::resource('comments','CommentController');
    Route::get('image-crop', 'ImageController@imageCrop');
    Route::post('image-crop', 'ImageController@imageCropPost');
    Route::get('/edit', function () {
        return view('user.editprofile');
    });
});

/********    API     *********/
Route::get('api/post/{feed}',function($feed){
    if($feed == "new"){
        $data = App\Post::with('user')->with('tag')->orderBy('id','desc')->paginate(10);      
    }else if($feed == "top"){
        $data = App\Post::with('user')->with('tag')->orderBy('postLike','desc')->paginate(10);
    }
    return response()->json($data);
});

Route::get('api/typenew',function(){
    $data = App\Type::orderBy('id','desc')->paginate(10);
    return response()->json($data);
});

Route::get('api/type/{feed}/{id}',function($feed,$id){
    if($feed == "new"){
        $data = App\Tag::with('user')->where('type_id', $id)->orderBy('id','desc')->paginate(10);
    }else if($feed == "top"){
        $data = App\Tag::with('user')->where('type_id', $id)->orderBy('tagVotes','desc')->paginate(10);
    }
    return response()->json($data);
});

Route::get('api/tag/{feed}/{id}',function($feed,$id){
    if($feed == "new"){
        $data = App\Post::with('user')->with('tag')->where('tag_id', $id)->orderBy('id','desc')->paginate(10);
    }else if($feed == "top"){
        $data = App\Post::with('user')->with('tag')->where('tag_id', $id)->orderBy('postLike','desc')->paginate(10);
    }
    return response()->json($data);
});

Route::get('api/user/{feed}/{id}',function($feed,$id){
    if($feed == "new"){
        $data = App\Post::with('user')->with('tag')->where('user_id', $id)->orderBy('id','desc')->paginate(10);
    }else if($feed == "top"){
        $data = App\Post::with('user')->with('tag')->where('user_id', $id)->orderBy('postLike','desc')->paginate(10);
    }
    return response()->json($data);
});


Route::get('api/draw',function(){
    $data = App\Draw::all();
    return response()->json($data);
});

Route::get('api/list',function(){
    $data = App\Tag::with('user')->with('type')->with('post')->orderBy('tagVotes','desc')->paginate(10);
    return response()->json($data);
});

Route::get('api/app/post',function(){
    $data = App\Post::with('user')->with('tag')->orderBy('id','desc')->take(6)->get();    
    return response()->json($data);
});

Route::get('api/app/tag',function(){
    $data = App\Tag::with('user')->with('type')->orderBy('id','desc')->take(6)->get();    
    return response()->json($data);
});

Route::get('api/app/story/{id}',function($id){
    $data = App\Post::with('user')->with('tag')->find($id);    
    return response()->json([$data]);
});

Route::get('api/app/feedtag/{id}',function($id){
    $data = App\Post::with('user')->with('tag')->where('tag_id', $id)->orderBy('id','desc')->get();
    return response()->json($data);
});

/********    API     *********/

Route::get('/new', function () {
    $types = App\Type::all();
    return view('feed.new',compact('types'));
});


Route::get('/types', function () {
    return view('feed.types');
});

Route::get('/feedtype/{type_id}', function ($type_id) {
    $type = App\Type::find($type_id);
    return view('feed.type',compact('type','type_id'));
});

Route::get('/feedtype/new/{type_id}', function ($type_id) {
    $type = App\Type::find($type_id);
    return view('feed.typenew',compact('type','type_id'));  
});

Route::get('/feed/{id}', function ($id) {
    $tag = App\Tag::with('user')->find($id);
    $tag->tagVotes += 1;
    $tag->save();
    $tags = App\Tag::where('type_id', $tag->type_id)->take(3)->get();    
    return view('feed.tag',compact('tag','id','tags'));
});

Route::get('/feed/new/{id}', function ($id) {
    $tag = App\Tag::with('user')->find($id);
    $tags = App\Tag::where('type_id', $tag->type_id)->take(3)->get();    
    return view('feed.tagnew',compact('tag','id','tags'));
});

Route::get('/profile/{id}', function ($id) {
    $user = App\User::find($id);
    return view('feed.user',compact('user','id'));
});

Route::get('/profile/new/{id}', function ($id) {
    $user = App\User::find($id);
    return view('feed.usernew',compact('user','id'));
});

Route::get('/story/{id}', function ($id) {
    $post = App\Post::with('user')->with('tag')->find($id);
    $post->postView += 1;
    $post->save();
    return view('story.view',compact('post','id'));
});

Route::get('/login', function () {
    return view('user.login');
});

Route::get('/register', function () {
    return view('user.create');
});

Route::post('login', 'LoginController@login');
Route::post('checkfacebook', 'LoginController@checkfacebook');
Route::get('logout', 'LoginController@logout');

Route::get('like/{id}/islikedbyme', 'LikeController@isLikedByMe');
Route::get('like/{id}/liked', 'LikeController@like');

Route::get('/sharepost/{id}', function ($id) {
    $post = App\Post::find($id);
    $post->postShare += 1;
    $post->save();
});

Route::get('/loginfacebook', function () {
    return view('welcome');
});

Route::get('/store', function () {
    $drawname = App\Drawname::all();
    return view('store.index',compact('drawname'));
});

Route::get('/store/draw/{id}', function ($id) {
    $drawuser = App\Draw::where('drawname_id',$id)->first();
    $drawname = App\Drawname::find($drawuser->drawname_id);    
    $user = App\User::find($drawname->user_id);
    $draw = App\Draw::where('drawname_id', $id)->get();    
    return view('store.show',compact('draw','user','drawname'));
});

Route::get('/more', function () {
    $title = 'more | jaipun';
    return view('feed.coming',compact('title'));
});

Route::get('/history', function () {
    $title = 'history | jaipun';
    return view('feed.coming',compact('title'));
});