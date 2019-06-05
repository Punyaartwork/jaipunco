@extends('photo.master')
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


    <form action="{{action('PhotoController@update',$id)}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">boon_id:</label>
      <input input type="text" name="boon_id" class="form-control" id="email" placeholder="Enter user_id"  value="{{$photo->boon_id}}">
    </div>

    <div class="type">
      <label for="email">photo:</label>
      <input input type="text" name="photo" class="form-control" id="email" placeholder="Enter photo" value="{{$photo->photo}}" >
    </div>

   <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
    
  </form>
</div>


@stop