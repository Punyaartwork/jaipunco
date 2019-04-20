@extends('post.master')
@section('title','Edit form')
@section('content')
<div class="container">
    <h1>create Edit</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form action="{{action('PostController@update',$id)}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">user_id:</label>
      <input input type="text" name="user_id" class="form-control" id="email" placeholder="Enter user_id"  value="{{$post->user_id}}">
    </div>

    <div class="type">
      <label for="email">tag_id:</label>
      <input input type="text" name="tag_id" class="form-control" id="email" placeholder="Enter tag_id"  value="{{$post->tag_id}}">
    </div>

    <div class="type">
      <label for="email">postName:</label>
      <input input type="text" name="postName" class="form-control" id="email" placeholder="Enter postName" value="{{$post->postName}}" >
    </div>

    <div class="type">
      <label for="email">post:</label>
      <input input type="text" name="post" class="form-control" id="email" placeholder="Enter post" value="{{$post->post}}" >
    </div>

    <div class="type">
      <label for="email">postDraw:</label>
      <input input type="text" name="postDraw" class="form-control" id="email" placeholder="Enter post" value="{{$post->postDraw}}" >
    </div>


    <div class="type">
      <label for="email">postView:</label>
      <input input type="text" name="postView" class="form-control" id="email" placeholder="Enter postView" value="{{$post->postView}}"  >
    </div>

    <div class="form-group">
      <label for="pwd">postLike:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter postLike" name="postLike" value="{{$post->postLike}}" >
    </div>

    <div class="form-group">
      <label for="pwd">postComment:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter postLike" name="postComment" value="{{$post->postComment}}" >
    </div>

    <div class="form-group">
      <label for="pwd">postShare:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter postLike" name="postShare" value="{{$post->postShare}}" >
    </div>

    <div class="type">
      <label for="email">postTime:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter postTime" name="postTime" value="{{$post->postTime}}" >
    </div><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
    
  </form>
</div>


@stop