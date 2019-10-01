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
                <div class="type">
                <label for="email">drawname_id:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter drawname_id" name="drawname_id">
                </div>
                <div class="type">
                <label for="email">alt:</label>
                <input type="text" class="form-control" id="alt" placeholder="Enter alt" name="alt">
                </div>
                <div class="type">
                <label for="email">good_id:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter good_id" name="good_id">
                </div>              
                <div class="type">
                <label for="email">drawLevel:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter drawLevel" name="drawLevel">
                </div>
                <div class="type">
                <label for="email">status_id:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter status_id" name="status_id">
                </div>
                <label for="file">Select image to upload:</label>
                <input type="file" name="file" id="file">
                <input class="btn btn-primary" type="submit" value="Upload" name="submit">
      <input type="hidden" value="{{ csrf_token() }}" name="_token">
    </form>

</div>  
@stop
