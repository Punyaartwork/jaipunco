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
            margin:0px;
          background:#fff;
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

      


      </style>

  
</head>

<body>

  <div id="app">
    <img src="/draw.png" style="width: 100%;">


 @yield('headpage')

   <!-- section -->
   <section class="section">
      <!-- content -->
     

      <transition name="slide-fade">
          
         <div class="content" style="
    display: inline-block;
" v-if="show">
  
  
           @yield('feedcontent')
           
            <!-- <div if="openmenu =! false" class="message">
            <ul v-for="menus in menu">
                <li v-text="menus"></li>
            </ul>
            </div>
            </div>
           end -->
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

  
  <script>
        
        // example demo content
        const app = new Vue({
            el: "#app",
            data: {
                show   : true, // display content after API request
                offset : 5,     // items to display after scroll
                display: 5,     // initial items
                trigger: 300,   // how far from the bottom to trigger infinite scroll
                items  : [],    // server response data
                end    : false, // no more resources
                posts: [],
                page:1,
                text:null,
                tags:[],
                onOff:false
            },
            computed: {

            },
            methods: {
                // check to see if we're at the bottom of the page
               
                },

            
        });

        Vue.filter('truncate', function (text) {
          return text.replace(/<\/?[^>]+(>|$)/g, "").replace(/&amp;nbsp;/gi,' ').substring(0, 50) + '...';
        });

        Vue.filter('timeSince', function(timeStamp) {
            timeStamp = new Date(timeStamp * 1000);
            var now = new Date(),
            secondsPast = (now.getTime() - timeStamp.getTime() ) / 1000;
        if(secondsPast < 60){
            return parseInt(secondsPast) + ' seconds ago';
        }
        if(secondsPast < 3600){
            return parseInt(secondsPast/60) + ' minutes ago';
        }
        if(secondsPast <= 86400){
            return parseInt(secondsPast/3600) + ' hours ago';
        }
        if(secondsPast <= 259200){
            hour = timeStamp.getHours();
            minute = timeStamp.getMinutes();
            return parseInt(secondsPast/86400) + ' day ago at  ' + hour +":"+ minute;
        }
        if(secondsPast > 259200){
            day = timeStamp.getDate();
            month = timeStamp.toDateString().match(/ [a-zA-Z]*/)[0].replace(" ","");
            year = timeStamp.getFullYear() == now.getFullYear() ? "" :  " "+timeStamp.getFullYear();
            hour = timeStamp.getHours();
            minute = timeStamp.getMinutes();
            if(hour < 10){
                hour = "0"+hour;
            }
            if(minute < 10){
                minute = "0"+minute;
            }
            return day + " " + month + year + " " + hour +":"+ minute;
        }
        });

        </script>


</body>

</html>
