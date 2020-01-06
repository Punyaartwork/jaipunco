@extends('locat.master')
@section('title','Welcome Tags')
@section('content')
    <div class="container">
    <h1>locat</h1>
    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead   style="background:#F44336">
      <tr>
        <th>id</th>
        <th>locat</th>
        <th>locatPhoto</th>
        <th>locatBg</th>  
        <th>locatColor</th>  
        <th>locatItem</th>  
        <th>locatLatitude</th>  
        <th>locatLongitude</th> 
        <th>locatDistance</th>  
        <th>locatTime</th> 
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($locats as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['locat']}}</td> 
        <td>{{$row['locatPhoto']}}</td> 
        <td>{{$row['locatBg']}}  </td> 
        <td>{{$row['locatColor']}}  </td> 
        <td>{{$row['locatItem']}}  </td>   
        <td>{{$row['locatLatitude']}}  </td>                       
        <td>{{$row['locatLongitude']}}  </td>
        <td>{{$row['locatDistance']}}  </td>     
        <td>{{$row['locatTime']}}  </td>               
        <td> <a href="{{action('LocatController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('LocatController@destroy',$row['id'])}}">
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
