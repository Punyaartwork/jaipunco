@extends('locat.master')
@section('title','locat form')
@section('content')

<div class="container">
    <h1>Edit locat</h1>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form  action="{{action('LocatController@update',$id)}}" method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">locat:</label>
      <input input type="text" name="locat" class="form-control" id="email" placeholder="Enter locat" value="{{$locat->locat}}">
    </div>

    <div class="type">
      <label for="email">locatPhoto:</label>
      <input input type="text" name="locatPhoto" class="form-control" id="email" placeholder="Enter locatPhoto" value="{{$locat->locatPhoto}}">
    </div>

    <div class="type">
      <label for="email">locatBg:</label>
      <input input type="text" name="locatBg" class="form-control" id="email" placeholder="Enter locatBg" value="{{$locat->locatBg}}">
    </div>

    <div class="type">
      <label for="email">locatColor:</label>
      <input input type="text" name="locatColor" class="form-control" id="email" placeholder="Enter locatColor" value="{{$locat->locatColor}}">
    </div>

    <div class="type">
      <label for="email">locatItem:</label>
      <input input type="text" name="locatItem" class="form-control" id="email" placeholder="Enter locatItem" value="{{$locat->locatItem}}">
    </div>

    <div class="form-group">
      <label for="pwd">locatLatitude:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter locatLatitude" name="locatLatitude"  value="{{$locat->locatLatitude}}">
    </div>

    <div class="form-group">
      <label for="pwd">locatLongitude:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter locatLongitude" name="locatLongitude"  value="{{$locat->locatLongitude}}">
    </div>
    <div class="form-group">
      <label for="pwd">locatDistance:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter locatDistance" name="locatDistance"  value="{{$locat->locatDistance}}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>
</div>



@stop