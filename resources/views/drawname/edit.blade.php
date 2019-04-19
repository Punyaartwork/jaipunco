@extends('type.master')
@section('title','Edit form')
@section('content')


  
<div class="container">
    <h1>Edit drawname</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <form action="{{action('DrawnameController@update',$id)}}"  method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">user_id:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter user_id" name="user_id"  value="{{$drawname->user_id}}">
    </div>

    <div class="type">
      <label for="email">drawName:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter drawName" name="drawName"  value="{{$drawname->drawName}}">
    </div>

    <div class="type">
      <label for="email">drawDetail:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter drawDetail" name="drawDetail"  value="{{$drawname->drawDetail}}">
    </div>

    <div class="form-group">
      <label for="pwd">drawTag:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter drawTag" name="drawTag" value="{{$drawname->drawTag}}" >
    </div>
    <div class="type">
      <label for="email">drawUse:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter drawUse" name="drawUse" value="{{$drawname->drawUse}}">
    </div><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>

</div>  


@stop