<html lang="en">
<head>
  <title>crop image profile jaipun</title>
  <script src="/js/jquery.js"></script>
  <script src="/js/croppie.js"></script>
  <link rel="stylesheet" href="/css/bootstrap-3.min.css">
  <link rel="stylesheet" href="/css/croppie.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>
<div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">crop image profile jaipun</div>
	  <div class="panel-body">


	  	<div class="row">
	  		<div class="col-md-4 text-center">
				<div id="upload-demo" style="width:350px"></div>
	  		</div>
	  		<div class="col-md-4" style="padding-top:30px;">
				<strong>Select Image:</strong>
				<br/>
				<input type="file" id="upload">
				<br/>
				<button class="btn btn-success upload-result">Upload Image</button>
	  		</div>

	  	</div>


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
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
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
			url: "/image-crop",
			type: "POST",
			data: {"image":resp},
			success: function (data) {
				window.location.href="/";
			}
		});
	});
});


</script>


</body>
</html>