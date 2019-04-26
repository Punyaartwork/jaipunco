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
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('user','UserController');
Route::resource('type','TypeController');
Route::resource('tag','TagController');
Route::resource('drawname','DrawnameController');
Route::resource('img','DrawController');
Route::resource('post','PostController');

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