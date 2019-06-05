@extends('photo.master')
@section('title','Welcome Homepage')
@section('content')

<div class="container">
    <h1>Card</h1>
    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead  style="background:#2E7D32">
      <tr>
        <th>id</th>
        <th>boon_id</th>
        <th>photo</th>   
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($photos as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['boon_id']}}</td> 
        <td>{{$row['photo']}} </td>    
        <td> <a href="{{action('PhotoController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('PhotoController@destroy',$row['id'])}}">
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
