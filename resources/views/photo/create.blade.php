@extends('photo.master')
@section('title','create post form')
@section('content')
  
<div class="container">
    <h1>Add photos  {{ \Session::get('boon_id')}}<button onclick="window.location.href='/'" class="btn btn-primary" style="float:right">POST</button></h1>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
    @endif

    @if(\Session::has('success'))
    <p class="alert alert-success">{{ \Session::get('success')}}</p>
    @endif


   

</div>

<head>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>
<div  style="width:100%;text-align:center;margin:10px">
				<strong>Select Image:</strong>
				<br/>

  <div  style="">
    <div id="upload-demo-i" style="background:#e1e1e1;margin-top:30px">
  <?php
  $photo = \App\Photo::where('boon_id', \Session::get('boon_id'))->get();
  ?>
        @foreach($photo as $photo)
        <a href="/deletephoto/{{$photo->id}}">delete</a><img src="{{$photo->photo}}" style="width:300px;height:200;" />
        @endforeach 
     </div>
</div>

				<input type="file" id="upload" style="margin:auto">
				<br/>
				<button class="btn btn-success upload-result">Upload Image</button>
  </div>



<div >
    <div >
      <div style="width:100%;">
        <div id="upload-demo" style="width:100%;height:auto;padding:0px;margin:auto;"></div>
      </div>
    </div>
    

</div>




<script type="text/javascript">


$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 600,
        height: 400,
    },
    boundary: {
        width: 700,
        height: 500
    }
});


$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		$.ajax({
			url: "/photo-crop",
			type: "POST",
			data: {"image":resp,"boon_id":{{\Session::get('boon_id')}}},
			success: function (data) {
        //alert(data.id);
				html = '<a href="/deletephoto/'+data.id+'">delete</a><img src="' + resp + '" style="width:300px;height:200;" />';
				$("#upload-demo-i").append(html);
			}
		});
	});
});


</script>


</body>


@stop
