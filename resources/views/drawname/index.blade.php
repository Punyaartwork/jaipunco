@extends('drawname.master')
@section('title','Drawname Table')
@section('content')
<div class="container">
<h1>Drawname</h1>
    @if(\Session::has('success'))
        <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead  style="background:#009688">
      <tr>
        <th>id</th>
        <th>user_id</th>
        <th>drawName</th>
        <th>drawDetail</th>        
        <th>drawTag</th>
        <th>drawUse</th>   
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($drawnames as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['user_id']}}</td>
        <td>{{$row['drawName']}}</td> 
        <td>{{$row['drawDetail']}}</td>          
        <td><img src="{{$row['drawTag']}}" alt="" style="width:100px;"></td> 
        <td>{{$row['drawUse']}}</td> 
        
        <td> <a href="{{action('DrawnameController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('DrawnameController@destroy',$row['id'])}}">
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