@extends('user.master')
@section('title','Type Table')
@section('content')
<div class="container">
<h1>USER</h1>
    @if(\Session::has('success'))
        <p class="alert alert-success">{{ \Session::get('success')}} {{\Session::get('user_id')}}</p>
    @endif

    <table class="table table-bordered">
    <thead  >
      <tr>
        <th>id</th>
        <th>facebook_id</th>
        <th>email</th>
        <th>name</th>   
        <th>password</th>  
        <th><b>edit</b></th>        
        <th><b>DETELE</b></th>                                                                                                
      </tr>
    </thead>
    <tbody>
    @foreach($users as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['facebook_id']}}</td> 
        <td>{{$row['email']}}</td> 
        <td>{{$row['name']}}</td> 
        <td>{{$row['password']}}</td>      
        
        <td> <a href="{{action('UserController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('UserController@destroy',$row['id'])}}">
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
