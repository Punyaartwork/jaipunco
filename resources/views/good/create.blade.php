@extends('good.master')
@section('title','create tag form')
@section('content')
  
<div class="container">
    <h1>create tags</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form action="{{url('good')}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">good:</label>
      <input input type="text" name="good" class="form-control" id="email" placeholder="Enter good" >
    </div>

    <div class="type">
      <label for="email">goodDetail:</label>
      <input input type="text" name="goodDetail" class="form-control" id="email" placeholder="Enter goodDetail" >
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@stop
