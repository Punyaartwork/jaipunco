<!--<html>
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
-->
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Jaipun</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <style>
  /* Created by Akash Soti follow me on twitter @akashsoti */
body {
  letter-spacing: 2px;
  background: #EFE2D1;
  font-family: "HelveticaNeue-UltraLight", "HelveticaNeue-Light",     "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida   Grande", sans-serif;
}

.iphone-outer {
  width: 320px;
  height: 640px;
  background-color: #141414;
  margin: 40px auto;
  border-radius: 40px;
  overflow: hidden;
  position: relative;
}
.iphone-outer:before {
  content: "";
  display: block;
  background-color: black;
  width: 295px;
  height: 470px;
  position: relative;
  top: 85px;
  left: 12px;
  border-radius: 5px;
}
.iphone-outer:after {
  content: "";
  display: block;
  background: white;
  width: 200px;
  height: 700px;
  z-index: 1;
  position: relative;
  top: -510px;
  left: -98px;
  opacity: 0.02;
  -webkit-transform: rotate(11deg);
  -moz-transform: rotate(11deg);
}
.iphone-outer .lock-screen {
  position: absolute;
  background: url("https://sv1.picz.in.th/images/2020/03/22/QqWddJ.jpg");
  /*background: url("https://sv1.picz.in.th/images/2019/07/21/KUgp3J.jpg");*/
  background-size: 100%;
  width: 285px;
  height: 460px;
  top: 90px;
  left: 17px;
}
.iphone-outer .brand {
  position: absolute;
  font-size: 3.2em;
  font-weight: 100;
  text-align: center;
}

.detail {
  position: static;
  font-size: 2.2em;
  font-weight: 100;
  text-align: center;
  margin-top: 20px;
}

.status-bar {
  position: relative;
  top: 0;
  width: 100%;
  height: 4.5%;
}

.pull-down {
  position: absolute;
  width: 13%;
  height: 30%;
  border-radius: 20px 20px 20px 20px;
  background: white;
  top: 9px;
  left: 44%;
  opacity: 0.4;
}

.carrier {
  letter-spacing: 0px;
  float: left;
  position: absolute;
  width: 45%;
  height: 100%;
}

.carrier.network-dots span {
  letter-spacing: 1px;
  position: relative;
  top: 0px;
  left: 5px;
  background: white;
  width: 5px;
  height: 5px;
  border-radius: 50%;
  display: inline-block;
}

.carrier.network-dots span:last-child {
  position: absolute;
  top: 4px;
  left: 53px;
  background: none;
  display: inline-block;
  width: 62px;
  color: white;
  font-size: 13px;
}

.carrier.network-dots span:nth-last-child(2) {
  background: none;
  border: 1px solid white;
  width: 3px;
  height: 3px;
}

.battery-info {
  position: relative;
  width: 30%;
  height: 100%;
  float: right;
}

.battery-info span {
  position: absolute;
  display: inline-block;
  float: left;
  width: 25%;
  font-size: 13px;
  top: 4px;
  left: 16%;
  color: white;
}

.battery-bar {
  top: 5px;
  left: 45px;
  position: absolute;
  float: right;
  width: 35%;
  height: 50%;
  border-radius: 2px;
  border: 1px solid white;
}
.battery-bar:before {
  position: relative;
  top: 1px;
  content: "";
  display: block;
  width: 40%;
  height: 80%;
  left: 1px;
  background: white;
}
.battery-bar:after {
  content: "";
  display: block;
  position: absolute;
  width: 3px;
  height: 45%;
  background: white;
  top: 3px;
  left: 100%;
}

.date-n-time {
  padding-top: 15px;
  width: 75%;
  height: 30%;
  margin: 0 auto;
}

.time {
  font-size: 68px;
  text-align: center;
  color: white;
  letter-spacing: 0.5px;
}

.date {
  font-family: "HelveticaNeue-Light";
  letter-spacing: 1.3px;
  text-align: center;
  color: white;
}

.unlock {
  font-family: "HelveticaNeue-Light";
  letter-spacing: 0px;
  text-align: center;
  font-size: 21px;
  position: relative;
  top: 47%;
  background: -webkit-gradient(linear, left top, right top, color-stop(0, #F1EDE8), color-stop(0.4, white), color-stop(0.5, white), color-stop(0.6, #F1EDE8), color-stop(1, #F1EDE8));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  -webkit-animation: slidetounlock 2s infinite linear;
  -moz-background-clip: text;
  -moz-text-fill-color: transparent linear;
  -moz-animation: slidetounlock 2s infinite linear;
}

@-webkit-keyframes slidetounlock {
  0% {
    background-position: -100px 0;
  }
  100% {
    background-position: 200px 0;
  }
}
@-moz-keyframes slidetounlock {
  0% {
    background-position: -100px 0;
  }
  100% {
    background-position: 200px 0;
  }
}
.lock-screen .bottom-actions {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 4.5%;
}

.pull-up {
  position: absolute;
  width: 13%;
  height: 30%;
  border-radius: 20px 20px 20px 20px;
  background: white;
  top: 30%;
  left: 44%;
  opacity: 0.7;
}

.camera {
  position: absolute;
  right: 7px;
  bottom: 7px;
  width: 30px;
  height: 18px;
  background: white;
  opacity: 0.7;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
}
.camera:before {
  content: "";
  display: block;
  position: relative;
  width: 16px;
  height: 4px;
  background: white;
  left: 7px;
  top: -4px;
  -webkit-border-radius: 5px 5px 0 0;
  -moz-border-radius: 5px 5px 0 0;
}
.camera:after {
  content: "";
  display: block;
  position: relative;
  width: 3px;
  height: 1px;
  background: white;
  left: 2px;
  top: -6px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
}

.lens {
  position: absolute;
  top: 2px;
  left: 9px;
  width: 9px;
  height: 9px;
  background: white;
  border-radius: 50%;
  border: 2px solid rgba(0, 0, 0, 0.1);
}
.lens:after {
  content: "";
  display: block;
  background: rgba(0, 0, 0, 0.1);
  width: 2px;
  height: 2px;
  border-radius: 50%;
  position: absolute;
  left: 12px;
  top: -1px;
}

.speaker {
  position: relative;
  width: 60px;
  height: 10px;
  background-color: #1c1c1c;
  top: -420px;
  margin: 0 auto;
  border-radius: 40px;
}
.speaker:before {
  content: "";
  width: 8px;
  height: 8px;
  top: 0px;
  border-radius: 50%;
  background-color: #0022FF;
  position: absolute;
  top: -20px;
  left: 25px;
  box-shadow: inset 0 0px 18px black;
  border: 1px solid #292929;
}

.home-button {
  content: "";
  display: block;
  position: relative;
  background-color: black;
  width: 55px;
  height: 55px;
  border-radius: 50%;
  margin: 0 auto;
  top: -112px;
  box-shadow: inset 0 0 10px #000000;
  border: 1px solid #1f1f1f;
}
.home-button:before {
  content: "";
  display: block;
  background-color: black;
  width: 17px;
  height: 17px;
  position: absolute;
  top: 18px;
  left: 17px;
  border-radius: 20%;
  border: 2px solid #2f2f2f;
}
.home-button .shine {
  position: absolute;
  width: 55px;
  height: 55px;
  background: -webkit-radial-gradient(circle, black, white);
  border-radius: 50%;
  opacity: 0.109;
}

.brand {
  text-align: center;
  font-size: 52px;
  font-weight: 100;
  color: #00A896;
}

.twodetail {
  position: static;
  font-size: 1.2em;
  font-weight: 100;
  text-align: center;
}
</style>
</head>

<body>

  <!-- * Please use chrome for best viewing. I look forward to your valuable comments and suggestions. I will be working a lot on it to make it as real as possible */ -->
<div class='iphone-outer'>
  <div class='lock-screen'></div>
  <div class='speaker'></div>
</div>
<div class='home-button'>
  <div class='shine'></div>
</div>
<div class='brand'>JaiMy App</div>
<div class='detail'>Check the list of things you should do and tutorials for training your mind in app.</div>
<div class='detail'>contact us</div>
<div class='twodetail'>Gmail :: jaipunproject@gmail.com</div>
  
  

</body>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130480379-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-130480379-1');
</script>
</html>
