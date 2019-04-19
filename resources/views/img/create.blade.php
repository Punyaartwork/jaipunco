@extends('img.master')
@section('title','create draw form')
@section('content')
  
<div class="container">
    <h1>create draw</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <form action="{{url('img')}}" method="post" enctype="multipart/form-data">
                <label for="file">Select image to upload:</label>
                <input type="file" name="file" id="file">
                <input class="btn btn-primary" type="submit" value="Upload" name="submit">
      <input type="hidden" value="{{ csrf_token() }}" name="_token">
    </form>

</div>  
@stop
