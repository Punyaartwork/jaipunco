<html>
<head>
<title>ThaiCreate.Com Tutorials</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

เข้าสู่ระบบโดย Facebook...
<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>

<form action="check.php" method="post" name="frmMain" id="frmMain">
	<input type="hidden" id="hdnFbID" name="hdnFbID">
	<input type="hidden" id="hdnName" name="hdnName">
	<input type="hidden" id="hdnEmail" name="hdnEmail"> 
</form>

</body>
</html>