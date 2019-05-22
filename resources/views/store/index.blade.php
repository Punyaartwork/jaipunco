@extends('store.master')
@section('title','jaipun store.')

@section('headpage')

<a href="/">
<div style="max-width: 340px; margin: 20px auto; display: block;"><div style="width: 70px; float: left;"><img src="https://image.flaticon.com/icons/svg/1765/1765052.svg" style="float: left; width: 70px;"></div><div style="width: 270px;float: left;"><div style="font-size: 26px; margin: 0px 15px; float: left; font-weight: 600; color: rgb(0, 181, 204);">ทำธรรมะให้น่าอ่าน</div><div style="font-size: 16px; margin: 0px 15px; float: left; font-weight: 600;">เพื่อทำให้ธรรมะเข้าถึงทุกเพศทุกวัยได้ง่ายขึ้น ผ่านภาพวาดที่ดูสบายตา</div></div></div>
</a>
<div style="
    height: 50px;
    float: left;
    width: 100%;
"></div>
    
<div style="max-width: 340px; margin: 20px auto; display: block;"><div style="width: 70px; float: left;"><img src="https://image.flaticon.com/icons/svg/1670/1670086.svg" style="float: left; width: 70px;"></div><div style="width: 270px; float: left;"><div style="font-size: 26px; margin: 0px 15px; float: left; font-weight: 600; color: rgb(0, 181, 204);">เป็นภาพประกอบเนื้อหา</div><div style="font-size: 16px; margin: 0px 15px; float: left; font-weight: 600;">เป็นคลังภาพที่จะใช้ในการทำเป็นภาพประกอบในหนังสือธรรมะในอนาคต</div></div></div>
<div style="
    height: 50px;
    float: left;
    width: 100%;
"></div>
@stop
@section('feedcontent')
    <style>

    </style>

    @foreach($drawname as $data)

    <a class="drawtag" href="/store/draw/{{$data->id}}">
    <img class="draw" src="{{$data->drawTag}}" > 
    <div class="drawname">  {{$data->drawName}}</div>
    </a>

            

    @endforeach
@stop