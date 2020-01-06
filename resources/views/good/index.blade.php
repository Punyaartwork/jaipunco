@extends('good.master')
@section('title','Welcome Tags')
@section('content')
    <div class="container">
    <h1>Good</h1>
    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif

    <table class="table table-bordered">
    <thead   style="background:#F44336">
      <tr>
        <th>id</th>
        <th>good</th>
        <th>goodPhoto</th>
        <th>goodDetail</th>  
        <th>goodBg</th>  
        <th>goodColor</th>  
        <th>goodItem</th>  
        <th>goodTags</th>   
        <th>goodLatitude</th>  
        <th>goodLongitude</th> 
        <th>goodDistance</th>  
        <th>locat_id</th> 
        <th>status_id</th>    
        <th><b>Edit</b></th>  
        <th><b>Deleie</b></th>                                                
      </tr>
    </thead>
    <tbody>
    @foreach($goods as $row)
    <tr>
        
        <td> {{$row['id']}}</td>    
        <td>{{$row['good']}}</td> 
        <td>{{$row['goodPhoto']}}</td> 
        <td>{{$row['goodDetail']}}  </td> 
        <td>{{$row['goodBg']}}  </td> 
        <td>{{$row['goodColor']}}  </td> 
        <td>{{$row['goodItem']}}  </td>         
        <td>{{$row['goodTags']}}  </td>  
        <td>{{$row['goodLatitude']}}  </td>                       
        <td>{{$row['goodLongitude']}}  </td>
        <td>{{$row['goodDistance']}}  </td>     
        <td>{{$row['locat_id']}}  </td>
        <td>{{$row['status_id']}}  </td>                    
        <td> <a href="{{action('GoodController@edit',$row['id'])}}">edit</a></td> 
        <td>
        <form method="post" class="detele_form"action="{{action('GoodController@destroy',$row['id'])}}">
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
