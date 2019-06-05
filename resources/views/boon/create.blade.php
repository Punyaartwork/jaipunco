@extends('boon.master')
@section('title','create post form')
@section('content')
  
<div class="container">
    <h1>Post Boon</h1>
    {{ \Session::get('boon_id')}}
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


    <form action="{{url('boon')}}" method="post">
    {{csrf_field()}}

    <label for="sel1">เลือกคำนำหน้า :</label>
      <select class="form-control" id="sel1" name="boonName">
        <option value="เอาบุญมาฝากนะครับ">เอาบุญมาฝากนะครับ</option>
        <option value="เอาบุญมาฝากนะคะ">เอาบุญมาฝากนะคะ</option>
        <option value="เอาบุญทุกๆบุญมาฝาก">เอาบุญทุกๆบุญมาฝาก</option>
        <option value="เอาบุญปลื้มสุด ๆ มาฝาก">เอาบุญปลื้มสุด ๆ มาฝาก</option>
        <option value="เอาบุญหลายบุญหลายวาระมาฝากครับ">เอาบุญหลายบุญหลายวาระมาฝากครับ</option>        
      </select>
      <br>

  <div class="type">
    <label for="email">รายละเอียดบุญ:</label>
    <input input type="text" name="boon" class="form-control" id="email" placeholder="Enter boon" >
  </div> <br>

    <button type="submit" class="btn btn-primary btn-lg">Next</button>
  </form>
</div>

@stop
