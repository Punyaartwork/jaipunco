@extends('post.master')
@section('title','Welcome Homepage')
@section('content')

<div class="container">
    <h1>POST</h1>
    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead  style="background:#2E7D32">
      <tr>
        <th>id</th>
        <th>user_id</th>
        <th>tag</th>
        <th>postName</th>  
        <th>post</th>  
        <th>postDraw</th>          
        <th>postView</th>  
        <th>postLike</th>  
        <th>postComment</th>  
        <th>postShare</th>          
        <th>postTime</th>     
        <th>post_ip</th>                       
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($posts as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['user_id']}}</td> 
        <td>{{$row['tag']['tagname']}}</td> 
        <td>{{$row['postName']}}   </td> 
        <td>{{$row['post']}} </td> 
        <td>{{$row['postDraw']}} </td>         
        <td>{{$row['postView']}} </td> 
        <td>{{$row['postLike']}} </td>  
        <td>{{$row['postComment']}} </td>  
        <td>{{$row['postShare']}} </td>          
        <td>{{$row['postTime']}} </td>                        
        <td>{{$row['post_ip']}}   </td>         
        <td> <a href="{{action('PostController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('PostController@destroy',$row['id'])}}">
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
