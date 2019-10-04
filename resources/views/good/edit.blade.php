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
      <input input type="text" name="goodBg" class="form-control" id="email" placeholder="Enter goodColor" value="{{$good->goodColor}}">
    </div>

    <div class="type">
      <label for="email">goodItem:</label>
      <input input type="text" name="goodItem" class="form-control" id="email" placeholder="Enter goodItem" value="{{$good->goodItem}}">
    </div>

    <div class="form-group">
      <label for="pwd">goodTags:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter goodTags" name="goodTags"  value="{{$good->goodTags}}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>
</div>



@stop