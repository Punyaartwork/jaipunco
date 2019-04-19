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

    <form action="{{action('DrawController@update',$id)}}"  method="post">
    {{csrf_field()}}
    <div class="type">
      <label for="email">drawname_id:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter drawname_id" name="drawname_id"  value="{{$draw->drawname_id}}">
    </div>

    <div class="type">
      <label for="email">draw:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter draw" name="draw"  value="{{$draw->draw}}">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
  </form>

</div>  


@stop