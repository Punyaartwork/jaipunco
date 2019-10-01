@extends('img.master')
@section('title','draw Table')
@section('content')
<div class="container">
<h1>DRAW</h1>
    @if(\Session::has('success'))
        <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead  style="background:#CDDC39">
      <tr>
        <th>drawname_id</th>
        <th>draw</th>
        <th>alt</th>
        <th>good_id</th>
        <th>drawLevel</th>
        <th>drawStatus</th>
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($draws as $row)
    <tr>
        
        <td> {{$row['drawname_id']}}</td>    
        <td><img src="{{$row['draw']}}"  style="width:100px;"alt=""></td>
        <td> {{$row['alt']}}</td>   
        <td> {{$row['good_id']}}</td>    
        <td> {{$row['drawLevel']}}</td>    
        <td> {{$row['drawStatus']}}</td>    
        <td> <a href="{{action('DrawController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('DrawController@destroy',$row['id'])}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">DETELE</button>
        </form>
        </td> 
    </tr>
    @endforeach
    <tbody>
    </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.detele_form').on('submit',function(){
            if(confirm("detele ??")){
                return true;
            }else{
                return false;
            }
        });
    });
    </script>
@stop