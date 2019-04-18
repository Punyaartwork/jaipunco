@extends('tag.master')
@section('title','Welcome Tags')
@section('content')
    <div class="container">
    <h1>TAGS</h1>
    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead   style="background:#F44336">
      <tr>
        <th>id</th>
        <th>user_id</th>
        <th>type</th>
        <th>tagname</th>  
        <th>tagDraw</th>  
        <th>tagDetail</th>  
        <th>tagStories</th>  
        <th>tagVotes</th>          
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($tags as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['user_id']}}</td> 
        <td>{{$row['type']['type']}}</td> 
        <td>{{$row['tagname']}}  </td> 
        <td>{{$row['tagDraw']}}  </td> 
        <td>{{$row['tagDetail']}}  </td> 
        <td>{{$row['tagStories']}}  </td>         
        <td>{{$row['tagVotes']}}  </td>         
        <td> <a href="{{action('TagController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('TagController@destroy',$row['id'])}}">
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
