<html>
<head>
<title>Login With facebook to jaipun</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>

<script>

  var bFbStatus = false;
  var fbID = "";
  var fbName = "";
  var fbEmail = "";

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2155150018131029',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


function statusChangeCallback(response)
{

		if(bFbStatus == false)
		{
			fbID = response.authResponse.userID;

			  if (response.status == 'connected') {
				getCurrentUserInfo(response)
			  } else {
				FB.login(function(response) {
				  if (response.authResponse){
					getCurrentUserInfo(response)
				  } else {
					console.log('Auth cancelled.')
				  }
				}, { scope: 'email' });
			  }
		}


		bFbStatus = true;
}


    function getCurrentUserInfo() {
      FB.api('/me?fields=name,email', function(userInfo) {

		  fbName = userInfo.name;
		  fbEmail = userInfo.email;

			$("#hdnFbID").val(fbID);
			$("#hdnName ").val(fbName);
			$("#hdnEmail").val(fbEmail);
			$("#frmMain").submit();

      });
    }

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}


</script>


<div style="
    text-align: center;
    margin: 25px;
">  
  <img src="https://sv1.picz.in.th/images/2019/02/25/TLqJve.png" style="
      width: 45px;
  "> 
  <a style="display: block; "><img src="https://sv1.picz.in.th/images/2019/02/25/TLqMgN.png" style="width: 150px;"></a>
  <h3>แพลตฟอร์มสำหรับให้ทุกคนทำธรรมะให้น่าอ่านด้วยภาพวาด</h3>
    
</div>
เข้าสู่ระบบโดย Facebook...
<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>

<form action="{{url('checkfacebook')}}" method="post" name="frmMain" id="frmMain">
{{ csrf_field() }}
	<input type="hidden" id="hdnFbID" name="hdnFbID">
	<input type="hidden" id="hdnName" name="hdnName">
	<input type="hidden" id="hdnEmail" name="hdnEmail"> 
</form>

</body>
</html>