@extends('photo.master')
@section('title','create post form')
@section('content')
  
<div class="container">
    <h1>เพิ่มภาพบุญของคุณ<button onclick="window.location.href='/'" class="btn btn-primary" style="float:right">POST</button></h1>

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
    <script src="/js/jquery.js"></script>
    <script src="/js/croppie.js"></script>
    <link rel="stylesheet" href="/css/bootstrap-3.min.css">
    <link rel="stylesheet" href="/css/croppie.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>


  <div  style="">
    <div id="upload-demo-i" style="margin:30px auto;text-align: center;border-bottom: 2px solid #B0BEC5;padding:10px 0px">
    <?php
    $photo = \App\Photo::where('boon_id', \Session::get('boon_id'))->get();
    ?>
        @foreach($photo as $photo)
        <img src="{{$photo->photo}}" style="width:300px;height:200;" /><a href="/deletephoto/{{$photo->id}}" style="  display: block;background: #fff;width: 30px;font-size: 20px;border-radius: 100%;color: #000;margin: 5px auto;">X</a>
        @endforeach 
     </div>
</div>


                <div  style="width:250px;margin:10px auto">
                                <strong>เลือกภาพ:</strong>
                                <br/>
                    <div class="custom-file">
                        <input type="file" id="upload" class="custom-file-input" >
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
				<br/>
				<button class="btn btn-success upload-result" style="margin:10px auto;display:block">Upload Image</button>
  </div>



<div >
    <div >
      <div style="width:100%;">
        <div id="upload-demo" style="width:100% !important ;height:auto !important;padding:0px;margin:auto;"></div>
      </div>
    </div>
    

</div>




<script type="text/javascript">

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


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
				html = '<img src="' + resp + '" style="width:300px;height:200;" /><a href="/deletephoto/'+data.id+'" style="  display: block;background: #fff;width: 30px;font-size: 20px;border-radius: 100%;color: #000;margin: 5px auto;">X</a>';
				$("#upload-demo-i").append(html);
			}
		});
	});
});


</script>


</body>


@stop
