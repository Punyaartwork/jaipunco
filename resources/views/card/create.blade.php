@extends('tag.master')
@section('title','create post form')
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


    <form action="{{url('card')}}" method="post">
    {{csrf_field()}}

  <div class="type">
    <label for="email">card:</label>
    <input input type="text" name="card" class="form-control" id="email" placeholder="Enter cardName">
  </div>

  <div class="type">
    <label for="email">cardPhoto:</label>
    <input input type="text" name="cardPhoto" class="form-control" id="email" placeholder="Enter card" >
  </div> <br>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@stop
