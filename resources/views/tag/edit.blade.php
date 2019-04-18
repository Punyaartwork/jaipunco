@extends('tag.master')
@section('title','Tag form')
@section('content')

<div class="container">
    <h1>Edit Tags</h1>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form  action="{{action('TagController@update',$id)}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">user_id:</label>
      <input input type="text" name="user_id" class="form-control" id="email" placeholder="Enter user_id" value="{{$tag->user_id}}">
    </div>

    <div class="type">
      <label for="email">type_id:</label>
      <input input type="text" name="type_id" class="form-control" id="email" placeholder="Enter type_id" value="{{$tag->type_id}}">
    </div>

    <div class="type">
      <label for="email">tagname:</label>
      <input input type="text" name="tagname" class="form-control" id="email" placeholder="Enter tagname" value="{{$tag->tagname}}" >
    </div>

    <div class="type">
      <label for="email">tagDraw:</label>
      <input input type="text" name="tagDraw" class="form-control" id="email" placeholder="Enter tagDraw" value="{{$tag->tagDraw}}">
    </div>

    <div class="type">
      <label for="email">tagDetail:</label>
      <input input type="text" name="tagDetail" class="form-control" id="email" placeholder="Enter tagDetail" value="{{$tag->tagDetail}}">
    </div>

    <div class="form-group">
      <label for="pwd">Votes:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter tagVotes" name="tagVotes"  value="{{$tag->tagVotes}}">
    </div>
    <div class="type">
      <label for="email">Stories:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter tagStories" name="tagStories" value="{{$tag->tagStories}}">
    </div><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>
</div>



@stop