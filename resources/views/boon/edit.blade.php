@extends('boon.master')
@section('title','Edit form')
@section('content')
<div class="container">
    <h1>create Edit</h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form action="{{action('BoonController@update',$id)}}" method="post">
    {{csrf_field()}}

    <label class="radio-inline"><input type="radio" name="boonName" checked value="{{$boon->boonName}}">{{$boon->boonName}}</label>
    <label class="radio-inline"><input type="radio" name="boonName" value="เอาบุญมาฝากนะครับ">เอาบุญมาฝากนะครับ</label>    
    <label class="radio-inline"><input type="radio" name="boonName" value="เอาบุญมาฝากนะคะ">เอาบุญมาฝากนะคะ</label>
    <label class="radio-inline"><input type="radio" name="boonName" value="เอาบุญทุกๆบุญมาฝาก">เอาบุญทุกๆบุญมาฝาก</label>
    <label class="radio-inline"><input type="radio" name="boonName" value="เอาบุญปลื้มสุด ๆ มาฝาก">เอาบุญปลื้มสุด ๆ มาฝาก</label>
    <label class="radio-inline"><input type="radio" name="boonName" value="เอาบุญหลายบุญหลายวาระมาฝากครับ">เอาบุญหลายบุญหลายวาระมาฝากครับ</label>
    

    <div class="type">
      <label for="email">boon:</label>
      <input input type="text" name="boon" class="form-control" id="email" placeholder="Enter boon" value="{{$boon->boon}}" >
    </div>

 <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_method" value="PATCH">
    
  </form>
</div>


@stop