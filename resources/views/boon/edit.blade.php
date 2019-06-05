@extends('boon.master')
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


    <form action="{{action('BoonController@update',$id)}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">user_id:</label>
      <input input type="text" name="user_id" class="form-control" id="email" placeholder="Enter user_id"  value="{{$boon->user_id}}">
    </div>

    <div class="type">
      <label for="email">boonName:</label>
      <input input type="text" name="boonName" class="form-control" id="email" placeholder="Enter boonName" value="{{$boon->boonName}}" >
    </div>

    <div class="type">
      <label for="email">boon:</label>
      <input input type="text" name="boon" class="form-control" id="email" placeholder="Enter boon" value="{{$boon->boon}}" >
    </div>

    <div class="type">
      <label for="email">boonView:</label>
      <input input type="text" name="boonView" class="form-control" id="email" placeholder="Enter boonView" value="{{$boon->boonView}}"  >
    </div>

    <div class="form-group">
      <label for="pwd">boonLike:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter boonLike" name="boonLike" value="{{$boon->boonLike}}" >
    </div>

    <div class="form-group">
      <label for="pwd">boonComment:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter boonLike" name="boonComment" value="{{$boon->boonComment}}" >
    </div>

    <div class="form-group">
      <label for="pwd">boonShare:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter boonLike" name="boonShare" value="{{$boon->boonShare}}" >
    </div>

    <div class="type">
      <label for="email">boonTime:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter boonTime" name="boonTime" value="{{$boon->boonTime}}" >
    </div><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
    
  </form>
</div>


@stop