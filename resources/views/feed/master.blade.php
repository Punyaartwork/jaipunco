<!DOCTYPE html>
<html lang="en" >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="/css/font.css">   
<link rel='shortcut icon' href='/css/3ByI2t.ico' type='image/x-icon'>        

  <meta charset="UTF-8">
  <title>@yield('title')</title>
  
  
  

      <style>
        body{
          background:@yield('background');
        }
        * {
          box-sizing: border-box;
        }

        .preloader {
          position: absolute;
          top: 0;
          left: 0;
          background-color: #74b0c8;
          width: 100vw;
          height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 9999;
          overflow: hidden;
        }

        #app {
          max-width: 820px;
          margin-left: auto;
          margin-right: auto;
        }

        .slide-fade-enter-active {
          transition: all .3s ease;
        }

        .slide-fade-leave-active {
          transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
        }

        .slide-fade-enter,
        .slide-fade-leave-to {
          -webkit-transform: translateX(10px);
                  transform: translateX(10px);
          opacity: 0;
        }

        .fade-enter-active,
        .fade-leave-active {
          transition: opacity .3s;
        }

        .fade-enter,
        .fade-leave-to {
          opacity: 0;
        }

        .fade-slow-enter-active,
        .fade-slow-leave-active {
          transition: opacity 3s;
        }

        .fade-slow-enter,
        .fade-slow-leave-to {
          opacity: 0;
        }


        .header {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background: #74b0c8;
            height: 55px;
            display: block;
            width: 100%;
            box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 2;
            transition: .3s;
            padding-top: 15px;
        
        }
        .header.small {
            height: 45px;
            padding-top: 10px;
        }
        
        
        .header nav{
            max-width: 700px;
            justify-content: space-between;
            margin: 0 auto;
            padding: 0 10px;
            position: relative;
            display: flex;
        }
        
        
        
        .navleft{
            flex: 1 1 10%;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        
        .navleft ul{
            flex: 1 1 20%;
            justify-content: space-between;
            align-items: center;
            /* padding-top: 15px; */
            box-sizing: border-box;
            display: flex;
            padding: 0px;
            margin: 0;
            box-sizing: border-box;
            list-style: none;
        }
        
        .navcenter{
            flex: 1 1 80%;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            justify-content: center;
            display: flex;
        }
        
        .navright{
            flex: 1 1 10%;
            padding: 0;
            margin: 0;
            padding-top: 0px;
            box-sizing: border-box;
        }
        
        .navright ul{
                /* flex: 1 1 30%; */
                justify-content: space-between;
                align-items: center;
                box-sizing: border-box;
                display: flex;
                margin: 0;
                padding: 0px;
                box-sizing: border-box;
                list-style: none;
        }
        


                /************************ FEED START********************************/

                a {
                color:#000;
                text-decoration: none;
                }

                .feed{
                    box-shadow: 0 10px 20px 0 rgba(0,0,0,.05)!important;
                    /* border-bottom: 2px solid rgba(0,0,0,.15)!important; */
                    border-radius: 15px;
                    word-wrap: break-word;
                    float: left;
                    margin: 10px 0px;
                    width: 100%;
                    background: #fff;
                }
                .feed-text{
                    float: left;
                    width: 60%;
                }
                
                .feed-tag{
                    margin: 50px 0px 0px 40px;
                    font-size: 20px;
                    font-weight: bold;
                    color: #717171;
                }
                
                .feed-title{
                    margin: 0px 20px 0px 40px;
                    display: inline-block;
                    font-size: 32px;
                    font-weight: 600;
                    color: #000;
                }
                .feed-content{
                    word-wrap: break-word;
                    height: 1em;
                    overflow: hidden;
                    margin: 0px 0px 0px 40px;
                    min-height: 25px;
                    color: #757575;
                    font-size: 18px;
                }
                

                .feed-like{
                    margin: 15px 0px 10px 40px;
                    float: left;
                    font-size: 12px;
                }

                .feed-like-icon{
                    float: left;
                    width: 20px;
                }

                .feed-like-text{
                    font-size: 12px;
                    float: left;
                    margin: 2px 10px;
                }


                .feed-comment{
                    margin: 15px 0px;
                    float: left;
                    font-size: 12px;
                }

                .feed-comment-icon{
                    float: left;
                    width: 20px;
                }

                .feed-comment-text{
                    font-size: 12px;
                    float: left;
                    margin: 2px 10px;
                }

                .feed-share{
                    margin: 15px 0px;
                    float: left;
                    font-size: 12px;
                }

                .feed-share-icon{
                    float: left;
                    width: 20px;
                }

                .feed-share-text{
                    font-size: 12px;
                    float: left;
                    margin: 2px 10px;
                }
                
                
                .feed-writer{
                    float: left;
                    width: 100%;
                    border-top: none;
                    padding-bottom: 16px;
                }
                
                .feed-writer-profile{
                    float: left;
                    margin: 5px 10px 5px 35px;
                    border-radius: 100px;
                    height: 40px;
                    width: 40px;
                    object-fit: cover;
                    display: inline-block;
                }
                        
                .feed-writer-name{
                    font-weight: 600;
                    color: #E53935;
                    font-size: 18px;
                }
                
                
                .feed-writer-detail{
                    font-weight: 500;
                    color: #000;
                    font-size: 16px;
                    margin-left: 10px;
                }
                        
                .feed-img{
                    float: left;
                    width: 40%;
                }

                .feed-img img{
                    width: 240px;
                    margin: 30px;
                }
                .feed-imgdraw{
                    display: none;
                }
                            
                        @media only screen and (max-width: 820px) {


                                .feed-tag{
                                    margin: 30px 0px 0px 40px;
                                    font-size: 16px;
                                    font-weight: bold;
                                    color: #717171;
                                }

                                .feed-title{
                                    margin: 0px 20px 0px 40px;
                                    display: inline-block;
                                    font-size: 30px;
                                    font-weight: 600;
                                    color: #000;
                                }


                                .feed-like{
                                    margin: 15px 0px 10px 40px;
                                    float: left;
                                    font-size: 12px;
                                }

                                .feed-like-icon{
                                    float: left;
                                    width: 16px;
                                }

                                .feed-like-text{
                                    font-size: 10px;
                                    float: left;
                                    margin: 0px 10px;
                                }


                                .feed-comment{
                                    margin: 15px 0px;
                                    float: left;
                                    font-size: 12px;
                                }

                                .feed-comment-icon{
                                    float: left;
                                    width: 16px;
                                }

                                .feed-comment-text{
                                    font-size: 10px;
                                    float: left;
                                    margin: 0px 10px;
                                }

                                .feed-share{
                                    margin: 15px 0px;
                                    float: left;
                                    font-size: 12px;
                                }

                                .feed-share-icon{
                                    float: left;
                                    width: 16px;
                                }

                                .feed-share-text{
                                    font-size: 10px;
                                    float: left;
                                    margin: 0px 10px;
                                }


                                .feed-writer{
                                    float: left;
                                    width: 100%;
                                    border-top: none;
                                    padding-bottom: 16px;
                                }

                                .feed-writer-profile{
                                    float: left;
                                    margin: 5px 10px 5px 35px;
                                    border-radius: 100px;
                                    height: 35px;
                                    width: 35px;
                                    object-fit: cover;
                                    display: inline-block;
                                }
                                        
                                .feed-writer-name{
                                    font-weight: 600;
                                    color: #E53935;
                                    font-size: 16px;
                                }


                                .feed-writer-detail{
                                    font-weight: 500;
                                    color: #000;
                                    font-size: 14px;
                                    margin-left: 10px;
                                }
                                        
                                .feed-img img{
                                    width: 200px;
                                    margin: 30px;
                                }
                                        
                        }
                        
                        
                        @media only screen and (max-width: 620px) {
                            .feed-text{
                                width:100%;
                            }

                            .feed-tag{
                            margin-left:20px; 
                            font-size: 20px;
                            }
                            .feed-title{
                                font-size: 32px;
                            margin-left:20px; 
                            }
                            .feed-content{
                            margin-left:20px; 
                            margin-right:20px; 
                            }
                            .feed-like{
                            margin-left:20px; 
                            }
                            .feed-writer-profile{
                            margin-left:20px; 
                            }
                            .feed-imgdraw{
                                display: block;
                                width: 240px;
                                margin: 10px auto;
                            }

                            .feed-img{
                                display:none;
                            }
                        
                        }
                
        /***************************FEED END************************************/


        .feedtype{
            box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
            /* border-bottom: 2px solid rgba(0,0,0,.15)!important; */
            border-radius: 15px;
            word-wrap: break-word;
            float: left;
            margin: 5px 0px;
            width: 100%;
            background: #fff;
        }
        .feedtype-text{
            float: left;
            width: 60%;
        }
        
        .feedtype-title{
            margin: 30px 20px 0px 40px;
            display: inline-block;
            font-size: 32px;
            font-weight: 600;
            color: #000;
        }
        .feedtype-content{
            word-wrap: break-word;
            height: 3em;
            overflow: hidden;
            margin: 0px 0px 0px 40px;
            min-height: 25px;
            color: #757575;
            font-size: 16px;
        }
    
                
        .feedtype-img{
            float: left;
            width: 40%;
        }

        .feedtype-img img{
            width: 140px;
            margin: 20px;
        }
                    
                @media only screen and (max-width: 820px) {

    
                }
                
                
                @media only screen and (max-width: 620px) {
                    .feedtype-img img {
                        width: 120px;
                    }

                }

        /***************************FEED TYPE END************************************/


        .feedtag{
            text-align: left;
            position: relative;
            width: 260px;
            height: 260px;
            background: rgb(255, 255, 255);
            margin: 5px;
            display: inline-block;border:1px solid #eee;
            border-radius: 5px;
            box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
        }

        .feedtag-title{
            color:#2196F3;
            font-size: 24px; 
            font-weight: bold;
        }

        .feedtag-detail{
            word-wrap: break-word !important;  
        }

        .feedtag-votes{
            position: absolute; 
        }

        .feedtag-votes img{
            float: left; 
            width: 20px;
        }
        
        .feedtag-votes span{
            font-size: 12px; 
            float: left; 
            margin: 2px 5px;
        }

        .feedtag-draw{
            margin-top: 48px;
            margin-left: 48px;
            width: 210px;
            height: 210px;
            overflow: hidden;
        }

        .feedtag-draw img{
            width: 280px;
        }
            
        @media only screen and (max-width: 870px) {

            .feedtag{
                margin: 5px;
                width: 220px;
                height: 220px;            
            }

            .feedtag-title{
                font-size: 18px;
            }

            .feedtag-detail{
                font-size: 14px;
            }
            .feedtag-draw{
                margin-top: 58px;
                margin-left: 58px;
                width: 160px;
                height: 160px;
            }

            .feedtag-draw img{
                width: 200px;
            }
        }

        @media only screen and (max-width: 720px) {

            .feedtag{
                margin: 2px;
                width: 160px;
                height: 160px;         
            }

            .feedtag-title{
                font-size: 16px;
            }

            .feedtag-detail{
                font-size: 12px;
            }
            .feedtag-draw{
                margin-top: 58px;
                margin-left: 58px;
                width: 100px;
                height: 100px;
            }

            .feedtag-draw img{
                width: 120px;
            }
        }

        .feedtag-img img{
            width: 160px;
            padding: 25px;
        }
        
        .feedtag-writer{
            text-align: left;
            width: 100%;
            border-top: none;
            margin-top: 20px;
        }
        
        .feedtag-writer-profile{
            float: left;
            margin: 5px 10px 5px 10px;
            border-radius: 100px;
            height: 35px;
            width: 35px;
            object-fit: cover;
            display: inline-block;
        }
                
        .feedtag-writer-name{
            font-weight: 600;
            color: #fff;
            font-size: 16px;
        }
        
        
        .feedtag-writer-detail{
            font-weight: 500;
            color: #000;
            font-size: 14px;
            margin-left: 10px;
        }

        /***************************FEED TAG END UPDATE 23/05/62 ************************************/

        .hometag{
            box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
            padding: 20px 20px;
            text-align: center;
            word-wrap: break-word;
            margin: 10px;
            background: rgb(135, 189, 182);
            border: 1px solid #EEEEEE;
            width: 240px;
            float: left;
            border-radius: 5px;
            white-space: initial !important;
        }

        .hometag-img{
            width: 160px;
            display: block;
            height: 160px;
            background: #fff;
            border-radius: 50%;
            margin: auto;
        }

        .hometag-title{
            color: #fff;
            margin: 0px;
            display: inline-block;
            font-size: 22px;
            font-weight: 600;
        }

        .hometag-img img{
            width: 160px;
            padding: 25px;
        }
        
        @media only screen and (max-width: 780px) {
            .hometag{
                margin: 20px;
                width: 200px;
                display: inline-block;
                position: relative;
                float: none;
            }
        }
            
        @media only screen and (max-width: 670px) {
            .hometag{
                margin: 10px;
                float: none;
                width: 200px;
            }
        }

        #taghome::-webkit-scrollbar { 
            display: none; 
        }

        /***************************HOME TAG END************************************/

        .profile-photo {
            width: auto;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: -60px;
        }

        .profile-photo-img {
            border-radius: 100px;
            height: 120px;
            object-fit: cover;
            width: 120px;
            display: inline-block;
            margin: 0px;
            padding: 0px;
        }

        .profile-followers {
            padding: 0px 20px;
            margin-top: 20px;
            padding-bottom: 25px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .profile-follow-int {
            font-size: 25px;
        }

        .profile-follow-text {
            margin-top: 5px;
            display: block;
            color: #8a8b8a;
        }

  /*********************toggle profile************************/
                
        .message {
            background: #fff;
            color: #000;
            max-width: 540px;
            padding: 40px;
            overflow: hidden;
            box-sizing: border-box;
            border: 1px solid rgb(238, 238, 238);
            font-size: 20px;
            box-shadow: 0px 1px 5px 0 rgba(0,0,0,.1)!important;
            display: block;
            margin: auto;
            margin-top:50px;
            
        }
        .message li{
            display: block;
        }

        .message h1 {
            color:#FFF;
        }

        .formlogin input{
            line-height: initial;
            width: 100%;
            padding: 4px 16px;
            border-width: 1px;
            border-style: solid;
            border-color: rgb(230, 230, 230);
            border-image: initial;
            border-radius: 4px;
            outline: 0px;
            transition: border-color 0.1s ease-in-out 0s;
            -webkit-appearance: textfield;
            background-color: white;
            -webkit-rtl-ordering: logical;
            cursor: text;
            font-size: 20px;
            font-family: 'cs_prajad', sans-serif;
        }

        .btn-login{
            vertical-align: middle;
            font-size: 20px;
            cursor: pointer;
            background-color: #007bff;
            color: rgb(255, 255, 255);
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.1s ease-in-out 0s, color 0.1s ease-in-out 0s, border-color 0.1s ease-in-out 0s;
            border: 1px solid #007bff;
            width: 100%;

        }
        .label-login{
            display: block;
            color: rgb(128, 128, 128);
            font-size: 18px;
            margin: 0px 0px 4px;
        }

        .profile {
            margin: auto;
            border-radius: 100px;
            height: 120px;
            width: 120px;
            object-fit: cover;
            display: block;
        }
        .btn-all a{
            margin: 10px 0px;
            float: left;
            text-align: center;
            padding: 10px;
            font-size: 20px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.1s ease-in-out 0s, color 0.1s ease-in-out 0s, border-color 0.1s ease-in-out 0s;
            border: 1px solid #007bff;
            width: 100%;
            font-weight: 600;
        }
        .bg-success{
            background: #ffffffc7;
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            z-index: 2;
            font-size: 20px;
            overflow-y: scroll;
            -webkit-overflow-scrolling:touch;
        }

        /*********************feed list start************************/
        .feedlist{
            box-shadow: 0 10px 20px 0 rgba(0,0,0,.05)!important;word-wrap: break-word;margin: 10px 5px;display: inline-block;max-width: 400px;background: #fff;text-align: left;
        }

        .feedlist-into{
            position: relative;
            height: 150px;
        }

        .feedlist-text{
            position: absolute;margin: 0px 25px;
        }

        .feedlist-votes{
            font-size: 12px;
            float: left;
            margin: 0px 5px;
        }

        .feedlist-draw{
            width: 150px;
            height: 150px;
            overflow: hidden;
            margin-left: 245px;
            margin-top: 20px;
            display: block;
        }

        .feedlist-draw img{
            width:200px
        }

        @media only screen and (max-width: 920px) {
            .feedlist{
                max-width: 320px;
            }
            .feedlist-draw{
                margin-left: 168px
            }
        }

        @media only screen and (max-width: 420px) {
            .feedlist{
                max-width: 300px;
            }
            .feedlist-draw{
                margin-left: 150px;
            }
        }
        /*********************feed list end************************/
        /*********************feed homoe start************************/
        .feedhome{
            width: 50%;display: inline-block;float: left;padding: 25px;
        }
        .feedhome-tag{
            font-size: 14px;
        }
        .feedhome-title{
            font-weight: bold;
            font-size: 20px;
        }
        .feedhome-post{
            font-size: 12px;width:70%;
        }
        .feedhome-text{
            margin-top: 10px;
        }
        .feedhome-name{
            font-size: 14px;
        }
        .feedhome-time{
            float: left;
            font-size: 12px;
        }

        .feedhome-time img{
            float: left;
            width: 12px;
        }

        .feedhome-time-into{
            font-size: 10px;
            float: left;
            margin: 0px 5px 0px 0px;
        }
        .feedhome-like{
            font-size: 10px;
            float: left;
            margin: 0px 5px;
        }
        .feedhome-draw{
            width: 120px;float: right;margin-top: -100px;
        }

        @media only screen and (max-width: 720px) {
            .feedhome {
                width: 100%;
            }
            .feedhome-draw {
                width: 180px;
                margin-top: -135px;
            }
            .feedhome-tag {
                font-size: 18px;
            }
            .feedhome-title {
                font-size: 32px;
            }
            .feedhome-post {
                font-size: 16px;
            }
            .feedhome-name {
                font-size: 20px;
            }
        }

        @media only screen and (max-width: 460px) {
            .feedhome-text {
                margin-top: 0px;
            }
            .feedhome {
                width: 100%;
                padding:15px 5px 15px 15px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.15) !important;
            }
            .feedhome-draw {
                width: 100px;
                margin-top: -95px;
            }
            .feedhome-title {
                font-size: 24px;
                width: 70%;
            }            
            .feedhome-tag {
                font-size: 16px;
            }
            .feedhome-post {
                font-size: 12px;
                display:none;
            }
            .feedhome-name {
                font-size: 12px;
            }
        }

        @media only screen and (max-width: 340px) {
            .feedhome-text{
                margin-top:0px;
            }

            .feedhome-draw {
                width: 90px;
                margin-top: -80px;
            }
            .feedhome-title {
                font-size: 22px;
            }            
            .feedhome-post {
                font-size: 12px;
            }
            .feedhome-name {
                font-size: 12px;
            }
        }
      </style>

  
</head>

<body>

  <div id="app">
  <div id="taghome" style=" margin-top: 100px;display: block;position: relative;">
    @yield('headpage')
    </div>
  <header class="header">
        <nav >
            <div class="navleft">
            <ul>
                <li>
                    <a href="/types">
                    <img src="/icon/sea-waves.svg" style="width: 20px;padding-top:5px">    
                    </a>
                 
                   
                </li>
                
                <li>
                <a href="#"></a>   
                </li>
            </ul>
            </div>
    
            <div class="navcenter">
            <a href="/">
                    <img src="/icon/namelogo.svg" style="width: 150px;">
            </a>
                
            </div>
    
            <div class="navright">
            <ul>
                    <li></li>
                    
                    <li>
                        <router-link class="nav__item" to="/search">
                    @if (\Session::has('user_id'))
                        <?php
                        $user = \App\User::find(\Session::get('user_id'));
                        ?>
                        <img src="{{$user->profile}}" style="width: 20px;padding-top:5px"  @click="onOff = !onOff">  
                    @else  
                        <img src="/icon/user.svg" style="width: 20px;padding-top:5px"  @click="onOff = !onOff">
                    @endif  
                        
                        </router-link>
                    </li>
                </ul>
            </div>    
        </nav>
        <nav style="
        background: #fff;
        max-width: 100%;
        margin-top: -1px;
        border-bottom: 1px solid #EEEEEE;
        ">
            
    
        <div class="navcenter" style="
            white-space: nowrap!important;
            overflow-y: auto;
            -webkit-overflow-scrolling:touch;
        ">
                @yield('nav')
               

                            </div>
                    
                                
                        </nav>
    
    </header>

   <!-- preloader -->
   <transition name="fade">
      <div class="preloader" v-if="!show">
         <span><img src="https://sv1.picz.in.th/images/2019/04/20/w7PfHE.png" style="width:80px;" ></span>
      </div>
   </transition>
   <!-- /preloader -->
   <!-- section -->
   <section class="section">
      <!-- content -->
      <div v-html="text">
          
</div>      
            <div v-if="onOff" class="bg-success">
                <div class="message">
                @if (\Session::has('user_id'))

                    <div style=" position: relative;">
                    <div style="float:right" @click="onOff = !onOff">X</div>
                        <a href="/image-crop" style=" position: absolute;left: 50%;">
                            <img src="https://image.flaticon.com/icons/svg/1782/1782703.svg" style="width: 35px;background: #fff;border-radius: 100%;">
                        </a>
                        <img src="{{ $user->profile }}" class="profile"> 
                    </div>
                   
                    <div style="
                        font-size: 32px;
                        text-align: center;
                        font-weight: 600;
                        margin-top: 10px;
                    ">{{ $user->name }}</div>
                    <div style="text-align: center;">{{ $user->detail }}</div>
                    <div style="width:100%;float:left;">
                        <div style="width: 300px;display: block;margin: auto;padding: 10px 0px;">
                            <div style="
                                float: left;
                                width: 100px;
                                font-size: 30px;
                                text-align: center;
                            ">{{ $user->stories }}<span style="
                                display: block;
                                font-size: 16px;
                                text-align: center;
                            ">stories</span>
                            </div>
                            <div style="
                                float: left;
                                width: 100px;
                                font-size: 30px;
                                text-align: center;
                                border-left: 1px solid #BDBDBD;
                                border-right: 1px solid #BDBDBD;
                            ">{{ $user->following }}<span style="
                                display: block;
                                font-size: 16px;
                                text-align: center;
                            ">following</span>
                            </div>
                            <div style="
                                float: left;
                                width: 100px;
                                font-size: 30px;
                                text-align: center;
                            ">{{ $user->followers }}<span style="
                                display: block;
                                font-size: 16px;
                                text-align: center;
                            ">followers</span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-all">
                        <a href="/post/create">write</a>                    
                        <a href="/edit">edit profile</a>
                        <a href="/logout">logout</a>
                    </div>

                @else
                    <div style="float:right" @click="onOff = !onOff">X</div>
                    <div class="formlogin">
                        <div style="text-align:center;">
                            <h3 class="card-title text-center" style="font-weight: 300;font-size:30px">Log in to Jaipun</h3>
                        </div>

                        <a href="/loginfacebook" style="
                            text-align: center;
                            display: block;
                            background: #355ba8;
                            color: #fff;
                            padding: 5px;
                            border-radius: 2px;
                            width: 300px;
                            font-size: 16px;
                            font-weight: 600;
                            margin: 10px auto;
                            border: 2px solid #d7e1f5;
                        "><img src="/icon/facebook-logo.svg" style="
                                width: 20px;
                                margin: 0px 10px;
                                margin-bottom: -5px;
                            ">Login with facebook
                        </a>
                        
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                            <div  style="color:red;">{{$error}}</div>
                            @endforeach    
                        @endif

                        @isset($comment)
                        <p style="color:red;">{{$comment}}</p>
                        @endisset
                        <form action="{{url('login')}}"  method="post">
                            {{csrf_field()}}
                            <div style="margin-bottom:32px">
                                <label class="label-login">Email address</label> 
                                <input type="text" name="email">
                            </div>
                            <div style="margin-bottom:32px">
                                <label class="label-login">Password</label> 
                                <input type="password"  name="password">  
                            </div> 
                            <div style="margin-bottom:32px">
                                <button type="submit" class="btn-login" >Sign in</button>   
                            </div>            
                                <div style=" text-align: center;"> Don't have an account? 
                                    <a href="/register" style=" font-weight: 600; color: #2196F3; ">Create One</a>
                                </div> 
                        </form>
                    </div>
                @endif

                 </div>
            </div>

      <transition name="slide-fade">
          
         <div class="content" v-if="show">

           @yield('feedcontent')

            <!-- end -->
            <transition name="fade-slow">
               <div class="notification is-info" v-if="end">
                  
               </div>
            </transition>
            <!-- /end -->
         </div>
      </transition>
      <!-- /content -->
   </section>
   <!-- /section -->
</div>
<!-- /app -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js'></script>
  <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130480379-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-130480379-1');
</script>

  
  @yield('vuefeed')


</body>

</html>
