@extends('type.master')
@section('title','create type form')
@section('content')
  
<div class="container">
    <h1>create types</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <form action="{{url('type')}}"  method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">type:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter type" name="type">
    </div>

    <div class="type">
      <label for="email">typeDetail:</label>
      <input type="text" class="form-control" placeholder="Enter type" name="typeDetail">
    </div>

    <div class="type">
      <label for="email">typeDraw:</label>
      <input type="text" class="form-control"  placeholder="Enter type" name="typeDraw">
    </div>

    <div class="form-group">
      <label for="pwd">View:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter View" name="typeView">
    </div>
    <div class="type">
      <label for="email">Stories:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter type" name="typeStories">
    </div><br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>  
@stop
