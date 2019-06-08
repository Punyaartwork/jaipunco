@extends('card.master')
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


    <form action="{{action('CardController@update',$id)}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">user_id:</label>
      <input input type="text" name="user_id" class="form-control" id="email" placeholder="Enter user_id"  value="{{$card->user_id}}">
    </div>

    <div class="type">
      <label for="email">card:</label>
      <input input type="text" name="card" class="form-control" id="email" placeholder="Enter card" value="{{$card->card}}" >
    </div>

    <div class="type">
      <label for="email">cardPhoto:</label>
      <input input type="text" name="cardPhoto" class="form-control" id="email" placeholder="Enter card" value="{{$card->cardPhoto}}" >
    </div>

    <div class="type">
      <label for="email">cardView:</label>
      <input input type="text" name="cardView" class="form-control" id="email" placeholder="Enter cardView" value="{{$card->cardView}}"  >
    </div>

    <div class="form-group">
      <label for="pwd">cardLike:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter cardLike" name="cardLike" value="{{$card->cardLike}}" >
    </div>

    <div class="form-group">
      <label for="pwd">cardComment:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter cardLike" name="cardComment" value="{{$card->cardComment}}" >
    </div>

    <div class="form-group">
      <label for="pwd">cardShare:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter cardLike" name="cardShare" value="{{$card->cardShare}}" >
    </div>

    <div class="type">
      <label for="email">cardTime:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter cardTime" name="cardTime" value="{{$card->cardTime}}" >
    </div><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
    
  </form>
</div>


@stop