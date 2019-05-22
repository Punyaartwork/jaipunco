@extends('store.master')
@section('title','jaipun store.')

@section('headpage')

<img src="/{{$drawname->drawTag}}" style="
        width: 180px;
        display:block;
        margin: auto;
">
<div style="
    text-align: center;
">
<div style="
    font-size: 36px;
">
{{$drawname->drawName}}</div>
<div>by {{$user->name}}</div>
</div>
@stop
@section('feedcontent')
<div class="drawcontent">
    @foreach($draw as $data)
    <img src="/{{$data->draw}}" style="
            width: 110px;
            margin: 20px;
        "> 
    @endforeach

    </div>
@stop