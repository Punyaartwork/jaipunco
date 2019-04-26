@extends('story.master')
@section('title',$post->postName.' | jaipun')
@section('css')
body{
    background:#fff;
}

************CSS content Start****************/
.content {
}

#app {
    background: #fff;
    max-width: 740px;
    border: 1px solid #e6e6e6;
    padding: 20px;
    padding-right: 100px;
    padding-left: 100px;
    margin-left: auto;
    margin-right: auto;
    display: block;
}


.content-title {
    margin: 0;
    width: 100%;
    font-size: 28px;
    text-align: center;
    float: left;
    font-weight: 600;
}

.content-type {
    float: right;
    width: 50%;
    margin-top: -10px;
    margin-bottom: 50px;
    opacity: 0.8;
}

.content-type-text {
    float: left;
    padding: 12px 10px;
    font-size: 16px;
    font-weight: 600;
    color: #008a0c;
}

.content-tag{
    float: left;
    width: 100%;
    margin-top: -10px;
    margin-bottom: 50px;
    opacity: 0.6;
}

.content-tag-text {
    text-align: center;
    padding: 10px 10px;
    font-weight: 600;
    font-size: 18px;
}

.content-article *{
    font-family: 'cs_prajad', sans-serif !important;
    word-wrap: break-word !important;
    margin: 5px;
    color: #000 !important;
    background-color: #fff !important;
    font-size: 20px !important;
    line-height: 45px !important;
}

.content-article{
    font-family: 'cs_prajad', sans-serif !important;
    word-wrap: break-word;
    margin: 5px;
    color: #000 !important;
    background-color: #fff !important;
    font-size: 20px !important;
    line-height: 45px !important;
}

.content-article img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    width: 160px !important;
}

    
.content-article * {
        font-family: 'cs_prajad', sans-serif !important;
        word-wrap: break-word;
        margin: 5px;
        color:#000 !important;
        background-color:#fff !important;
        font-size: 20px !important;
        line-height: 45px !important;
        /*min-width: 100%;*/
        }

        .content-article{
        font-family: 'cs_prajad', sans-serif !important;
        word-wrap: break-word;
        margin: 5px;
        color:#000 !important;
        background-color:#fff !important;
        font-size: 20px !important;
        line-height: 45px !important;
        /*min-width: 620px;*/
        }
    
    
    

.content-profile{
    padding: 20px 40px;
    display: inline-block;
    width: 100%;
}

.content-profile-into{
float: left;
width: 25%;
}

.content-profile-img{
border-radius: 100px;
height: 80px;
object-fit: cover;
width: 80px;
display: inline-block;
margin: 0px 0px;
padding: 0px;
}

.content-profile-text{
float: left;
width: 55%;
}

#name{
font-weight: 600;
font-size:24px
}


@media screen and (max-width: 520px) {

.content-into {
margin: 0px 20px;
}
.content-profile-into {
float: none;
text-align: center;
width: 100%;
}
.content-profile-text {
float: none;
text-align: center;
width: 100%;
margin: 15px 0px;
}

#detail{
font-size: 16px;
font-weight: 400;
}
#closecontent{
top: 0;
right: 0;
left: 0;

}


}


#closecontent {
position: fixed;
top: 50px;
right: 80px;
z-index: 4;
}
    
        .comments{
        width: 100%;
        float: left;
        border-bottom: 1px solid #eee;
        width: 100%;
        padding: 15px 0px;
    }
    .comments-img{
        float: left;
        height: 40px;
        width: 40px;
        border-radius: 100px;
        object-fit: cover;
        display: inline-block;
        margin: 0px 15px;
        padding: 0px;
    }
    
    .comments-name{
        float: left;
        width: 50%;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    #frm-comment{
        float: left;
        width: 100%;
        margin: 30px 10px;
    }
    
    #Share {
        font-size: 15px;
        text-align: center;
        padding: 10px;
        max-width: 240px;
        position: absolute;
        bottom: 140%;
        right: 0;
        border: 1px solid #e6e6e6;
        background: #fff;
        margin: 0px 0px;
        box-shadow: 0 1px 2px rgba(0,0,0,.25), 0 0 1px rgba(0,0,0,.35);
    }
    
    #Share:before {
        position: absolute;
        bottom: -12px;
        right: 21px;
        display: inline-block;
        border-right: 12px solid transparent;
        border-top: 12px solid #ccc;
        border-left: 12px solid transparent;
        border-top-color: rgba(0,0,0,0.2);
        content: '';
    }
    #Share:after {
        position: absolute;
        bottom: -10px;
        right: 21px;
        display: inline-block;
        border-right: 12px solid transparent;
        border-top: 12px solid #fff;
        border-left: 12px solid transparent;
        content: '';

    }
    
    
    .Hide
    {
        display:none;
    }
    
    
    .toggle{
        margin-top:0px;
    }
    
    
    #edit {
        display:none;
        position: absolute;
        top: 80%;
        right: 0px;
        width: 100%;
        border: 1px solid #e6e6e6;
        font-size:14px;
        background:#fff;
        width:60px;
        height:40px;
        display:none;
        padding:5px;
        box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
    }
    
    #edit:before {
        position: absolute;
        top: -7px;
        right: 9px;
        display: inline-block;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #ccc;
        border-left: 7px solid transparent;
        border-bottom-color: rgba(0,0,0,0.2);
        content: '';
    }
    #edit:after {
        position: absolute;
        top: -6px;
        right: 10px;
        display: inline-block;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #fff;
        border-left: 6px solid transparent;
        content: '';
    }
    
    
    .Hide
    {
        display:none;
    }
    
    
    .btnedit{
        margin:10px;
    }

    @media only screen and (max-width: 900px) {
        .content-article{
        min-width: 0px;
        }

        #app{
            padding: 20px;
            padding-right: 50px;
            padding-left: 50px;
        }


    }
        


    @media only screen and (max-width: 620px) {

        #app{
            padding: 20px;
            padding-right: 20px;
            padding-left: 20px;
        }

        .content-article * {
            font-size: 18px !important;
        line-height: 40px !important;
        }

        .content-article{
        font-size: 18px !important;
        line-height: 40px !important;
        }
        .content-title {
        font-size: 28px;
        font-weight: 600;
    }


    }



    .iconlike{
        float: left;
        padding: 8px;
        width: 50px;
        border: 1px solid rgba(0,0,0,.15);
        border-radius: 50px;
        opacity: 1;
    }
    .iconlike:hover { 
        border: 2px solid #ff7f7f;
    }
        
    .iconlike:active { 
        border: 2px solid #ff7f7f;
        box-shadow: 0px 0px 15px 1px rgba(0,0,0,.15)!important;
    }



    .check{
        display:none;    
        position: absolute;  
        position: fixed;
        top: 30%;
        left: 40%;
        width:80px
    }
        
    .textlike{
        padding: 15px 5px 15px 15px;
        float: left;
        font-size: 14px;
        /* font-weight: 600; */
    }

@stop
@section('content')



  <div class="content-title">{{$post->postName}}</div> 
        <div class="content-tag">
          <div class="content-tag-text">{{$post->tag->tagname}}</div>
        </div>
        <div><img src="{{$post->postDraw}}" alt="" style="
    width: 200px;
    display: block;
    margin: auto;
"></div>
    <article class="content-article" v-html="'{{$post->post}}'"></article>
    <div style="
    width: 100%;
    border-bottom: 1px solid rgba(0,0,0,.05)!important;
    padding-bottom: 25px!important;
    margin-top:60px;
    ">
        <div style="  width: 100%;"><img class="iconlike" src="https://image.flaticon.com/icons/svg/1531/1531027.svg">
            <span class="textlike">{{$post->postLike}}  liked</span></div>



    <!-- /////////////////////   -->
    <div class="content-profile">
      <div class="content-profile-into">
        <img class="content-profile-img" src="{{$post->user->profile}}">
      </div>
    
    <div class="content-profile-text">
      <div id="name">{{$post->user->name}}</div>
      <div id="detail">{{$post->user->detail}}</div>
    </div>
    </div>

    <!-- /////////////////////   -->

    
  </div>
    

@stop

@section('vuefeed')
        <script>
        // example demo content
        const app = new Vue({
            el: "#app",
            data: {
                show   : false, // display content after API request
                end    : false, // no more resources
                text:null,
                post:null,
                content:null,
            },
            computed: {
                // slice the array of data to display
            },
            methods: {
                // check to see if we're at the bottom of the page
                // preform API request to the server
                fetch() {
                    window.setTimeout(() => {
                        this.$http.get('/post/{{$id}}').then(function(response){                      
                            this.post = response.body;   
                            //alert(JSON.stringify(this.post));
                        }, function(error){
                            console.log(error.statusText);
                        });
                        this.show = true;
                    }, 2000);
                },

            },
            mounted() {
                // track scroll event
            },
            created() {
                // get the data by performing API request
                this.fetch();
            }
        });

   

        </script>
@stop