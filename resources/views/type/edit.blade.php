@extends('type.master')
@section('title','Edit form')
@section('content')


  
<div class="container">
    <h1>Edit types</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <form action="{{action('TypeController@update',$id)}}"  method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">type:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter type" name="type"  value="{{$type->type}}">
    </div>

    <div class="type">
      <label for="email">typeDetail:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter type" name="typeDetail"  value="{{$type->typeDetail}}">
    </div>

    <div class="type">
      <label for="email">typeDraw:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter type" name="typeDraw"  value="{{$type->typeDraw}}">
    </div>

    <div class="form-group">
      <label for="pwd">View:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter View" name="typeView" value="{{$type->typeView}}" >
    </div>
    <div class="type">
      <label for="email">Stories:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter type" name="typeStories" value="{{$type->typeStories}}">
    </div><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>

</div>  


@stop