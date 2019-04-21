@extends('user.master')
@section('title','Edit form')
@section('content')


  
<div class="container">
    <h1>Edit Users</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


  <form action="{{action('UserController@update',$id)}}"   method="post"  enctype="multipart/form-data">
    {{csrf_field()}}

      <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
      </div>
      <div class="form-group">
        <label for="email">name:</label>
        <input type="text" class="form-control"  name="name" value="{{$user->name}}">
      </div>
      <div class="form-group">
        <label for="pwd">profile:</label>
        <input type="file" name="file" id="file">
        <input type="text" class="form-control" id="pwd"  name="profile" value="{{$user->profile}}">
      </div>
      <div class="form-group">
        <label for="pwd">detail:</label>
        <input type="text" class="form-control" id="pwd"  name="detail" value="{{$user->detail}}">
      </div>

      <div class="form-group form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox"> Remember me
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <input type="hidden" name="_method" value="PATCH">
    </form>

</div>  


@stop