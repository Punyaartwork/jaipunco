@extends('img.master')
@section('title','Edit draw form')
@section('content')


  
<div class="container">
    <h1>Edit draw</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <form action="{{action('DrawController@update',$id)}}"  method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="type">
      <label for="email">drawname_id:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter drawname_id" name="drawname_id"  value="{{$draw->drawname_id}}">
    </div>
    <div class="type">
      <label for="email">alt:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter alt" name="alt"  value="{{$draw->alt}}">
    </div>
    <div class="type">
      <label for="email">good_id:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter good_id" name="good_id"  value="{{$draw->good_id}}">
    </div>
    <div class="type">
      <label for="email">drawLevel:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter drawLevel" name="drawLevel"  value="{{$draw->drawLevel}}">
    </div>
    <div class="type">
      <label for="email">status_id:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter status_id" name="status_id"  value="{{$draw->status_id}}">
    </div>
    <div class="type">
      <label for="email">draw:</label>
        <input type="file" name="file" id="file">
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
        <input type="text" class="form-control" id="email" placeholder="Enter draw" name="draw"  value="{{$draw->draw}}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>

</div>  


@stop