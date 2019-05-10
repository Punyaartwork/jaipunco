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
          background:#fafafa;
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
        height: 70px;
        display: block;
        width: 100%;
        box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 2;
        transition: .3s;
        padding-top: 30px;
        
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
        
        @yield('css')

      </style>

  
</head>

<body>

  <div id="app">
  <div id="taghome" style="
    margin-top: 80px;
    display: block;
    overflow-x: auto;
    position: relative;
    white-space: nowrap;
">
@yield('headpage')
</div>
  <header class="header">
  <nav style="
  ">
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
                  <!--<a id="btnsearch" href="#" style="">-->
                      <img src="/icon/magnifying-glass.svg" style="width: 20px;padding-top:5px">    
                      </router-link>
                  </li>
              </ul>
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

      <transition name="slide-fade">
          
         <div class="content" v-if="show">

           @yield('content')

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
