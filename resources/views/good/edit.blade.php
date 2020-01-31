@extends('good.master')
@section('title','Good form')
@section('content')

<div class="container">
    <h1>Edit Good</h1>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form  action="{{action('GoodController@update',$id)}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">good:</label>
      <input input type="text" name="good" class="form-control" id="email" placeholder="Enter good" value="{{$good->good}}">
    </div>

    <div class="type">
      <label for="email">goodPhoto:</label>
      <input input type="text" name="goodPhoto" class="form-control" id="email" placeholder="Enter goodPhoto" value="{{$good->goodPhoto}}">
    </div>

    <div class="type">
      <label for="email">goodDetail:</label>
      <input input type="text" name="goodDetail" class="form-control" id="email" placeholder="Enter goodDetail" value="{{$good->goodDetail}}" >
    </div>

    <div class="type">
      <label for="email">goodBg:</label>
      <input input type="text" name="goodBg" class="form-control" id="email" placeholder="Enter goodBg" value="{{$good->goodBg}}">
    </div>

    <div class="type">
      <label for="email">goodColor:</label>
      <input input type="text" name="goodColor" class="form-control" id="email" placeholder="Enter goodColor" value="{{$good->goodColor}}">
    </div>

    <div class="type">
      <label for="email">goodItem:</label>
      <input input type="text" name="goodItem" class="form-control" id="email" placeholder="Enter goodItem" value="{{$good->goodItem}}">
    </div>

    <div class="form-group">
      <label for="pwd">goodTags:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodTags" name="goodTags"  value="{{$good->goodTags}}">
    </div>

    <div class="form-group">
      <label for="pwd">goodLatitude:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodLatitude" name="goodLatitude"  value="{{$good->goodLatitude}}">
    </div>

    <div class="form-group">
      <label for="pwd">goodLongitude:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodLongitude" name="goodLongitude"  value="{{$good->goodLongitude}}">
    </div>
    <div class="form-group">
      <label for="pwd">goodDistance:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodDistance" name="goodDistance"  value="{{$good->goodDistance}}">
    </div>
    <div class="form-group">
      <label for="pwd">locat_id:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter locat_id" name="locat_id"  value="{{$good->locat_id}}">
    </div>
    <div class="form-group">
      <label for="pwd">status_id:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter status_id" name="status_id"  value="{{$good->status_id}}">
    </div>'goodStory','goodIcon','goodDhamma','goodResult','goodLike','goodView','goodDonate','goodDonateMax'
    <div class="form-group">
      <label for="pwd">goodStory:</label>
      <textarea class="form-control" rows="5"id="email" name="goodStory" placeholder="Enter goodStory" >{{$good->goodStory}}</textarea>
    </div>
    <div class="form-group">
      <label for="pwd">goodIcon:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodIcon" name="goodIcon"  value="{{$good->goodIcon}}">
    </div>
    <div class="form-group">
      <label for="pwd">goodDhamma:</label>
      <textarea class="form-control" rows="5"id="email" name="goodDhamma" placeholder="Enter goodDhamma" >{{$good->goodDhamma}}</textarea>
    </div>
    <div class="form-group">
      <label for="pwd">goodResult:</label>
      <textarea class="form-control" rows="5"id="email" name="goodResult" placeholder="Enter goodResult" >{{$good->goodResult}}</textarea>
    </div>
    <div class="form-group">
      <label for="pwd">goodLike:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodLike" name="goodLike"  value="{{$good->goodLike}}">
    </div>
    <div class="form-group">
      <label for="pwd">goodView:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodView" name="goodView"  value="{{$good->goodView}}">
    </div>
    <div class="form-group">
      <label for="pwd">goodDonate:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodDonate" name="goodDonate"  value="{{$good->goodDonate}}">
    </div>
    <div class="form-group">
      <label for="pwd">goodDonateMax:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodDonateMax" name="goodDonateMax"  value="{{$good->goodDonateMax}}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>
</div>



@stop