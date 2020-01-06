@extends('locat.master')
@section('title','create locat form')
@section('content')
  
<div class="container">
    <h1>create locat</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form action="{{url('locat')}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">locat:</label>
      <input input type="text" name="locat" class="form-control" id="email" placeholder="Enter locat" >
    </div>

    <div class="type">
      <label for="email">locatPhoto:</label>
      <input input type="text" name="locatPhoto" class="form-control" id="email" placeholder="Enter locatPhoto" >
    </div>

    <div class="type">
      <label for="email">locatLatitude:</label>
      <input input type="text" name="locatLatitude" class="form-control" id="email" placeholder="Enter locatLatitude" >
    </div>

    <div class="type">
      <label for="email">locatLongitude:</label>
      <input input type="text" name="locatLongitude" class="form-control" id="email" placeholder="Enter locatLongitude" >
    </div>

    <div class="type">
      <label for="email">locatDistance:</label>
      <input input type="text" name="locatDistance" class="form-control" id="email" placeholder="Enter locatDistance" >
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@stop
