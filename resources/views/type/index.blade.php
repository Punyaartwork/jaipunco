@extends('type.master')
@section('title','Type Table')
@section('content')
<div class="container">
<h1>TYPES</h1>
    @if(\Session::has('success'))
        <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead  style="background:#ffeb3b">
      <tr>
        <th>id</th>
        <th>type</th>
        <th>detail</th>
        <th>draw</th>        
        <th>View</th>
        <th>Stories</th>   
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($types as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['type']}}</td>
        <td>{{$row['typeDetail']}}</td> 
        <td>{{$row['typeDraw']}}</td>          
        <td>{{$row['typeView']}}</td> 
        <td>{{$row['typeStories']}}</td> 
        
        <td> <a href="{{action('TypeController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('TypeController@destroy',$row['id'])}}">
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
