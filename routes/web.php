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

Route::get('/', function () {
    return view('feed.top');
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

/********    API     *********/

Route::get('/new', function () {
    return view('feed.new');
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
    return view('feed.tag',compact('tag','id'));
});

Route::get('/feed/new/{id}', function ($id) {
    $tag = App\Tag::with('user')->find($id);
    return view('feed.tagnew',compact('tag','id'));
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
    return view('story.view',compact('post','id'));
});

Route::get('/login', function () {
    return view('user.login');
});

Route::get('/register', function () {
    return view('user.create');
});

Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');