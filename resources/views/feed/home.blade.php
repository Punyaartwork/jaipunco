@extends('feed.master')
@section('title','Jaipun')
@section('background','#fff')
@section('nav')
<!-- https://image.flaticon.com/icons/svg/263/263115.svg -->
<div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
    display: flex;text-align: center;max-width: 450px;margin: 0px auto;">
    <a href="#" style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/262/262584.svg" style="width: 20px;">
    </a> 


    <!-- https://image.flaticon.com/icons/svg/865/865132.svg -->
    <a href="/card" style="padding: 10px 15px; font-size: 14px;width: 20%;">
        <img src=" https://image.flaticon.com/icons/svg/238/238693.svg" style="width: 20px;">
    </a> 


     <!--     https://image.flaticon.com/icons/svg/1001/1001287.svg -->

    <a href="/list" style="padding: 10px 15px; font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/1001/1001399.svg" style="width: 20px;">
    </a>

    <!-- https://image.flaticon.com/icons/svg/132/132233.svg -->
    <a href="/history" style="padding: 10px 15px;font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/132/132284.svg" style="width: 20px;">
    </a>

    <!-- https://image.flaticon.com/icons/svg/149/149022.svg -->
    <a href="/more" style="padding: 10px 15px;font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/149/149946.svg" style="width: 20px;">
    </a>
</div>
 @stop
@section('feedcontent')
    <!--<div style="
        white-space: nowrap !important;
        overflow-x: scroll;
        -webkit-overflow-scrolling:touch;
    ">
        @foreach($tags as $tags)
        <article class="feedlist" style="border-radius: 5px;
        border: 1px solid rgb(238, 238, 238);
        box-shadow: 0 1px 6px 0 rgba(0,0,0,.05)!important;">
            <div class="feedlist-into">
                <a href="/feed/{{$tags->id}}">
                <div class="feedlist-text">
                    <div style="font-size: 14px;" >{{$tags->type->type}}</div>    
                    <div style="
                        font-weight: bold;font-size: 20px;
                    " >{{$tags->tagname}}</div>
                    <div style="font-size: 12px;width: 80%;">{{$tags->tagDetail}}</div>
                    <div >{{$tags->user->name}}</div>   
                    <img src="https://image.flaticon.com/icons/svg/1721/1721997.svg" style="
                        width: 15px;
                        float: left;
                    "> <span class="feedlist-votes">{{$tags->tagVotes}}</span>
                    <br>    
                </div>
                <div  class="feedlist-draw">
                    <img  src="{{$tags->tagDraw}}">
                </div>     
                </a>
        </article>
        @endforeach
    </div>-->
    <h1 style="
        font-size: 20px;
        margin: 0px;
        border-bottom: 1px solid rgba(0,0,0,.15)!important;
        padding: 30px 15px 15px 15px;
    ">Featured for members</h1>
    <div>
        @foreach($tops as $data)
        <div class="feedhome">
            <a href="/feed/{{$data->tag->id}}">
                <div class="feedhome-tag">{{$data->tag->tagname}}</div> 
            </a>
            <a href="/story/{{$data->id}}">
                <div class="feedhome-title">{{$data->postName}}</div> 
                <div class="feedhome-post" :text-content.prop="'{{$data->post}}' | truncate" ></div>  
            </a>
            <div class="feedhome-text" >
                <a href="/profile/{{$data->user->id}}">
                    <div class="feedhome-name">
                        {{$data->user->name}}  
                    </div>
                </a>
                <div class="feedhome-time">

                    <span class="feedhome-time-into"  :text-content.prop="{{$data->postTime}} | timeSince" ></span>
                    
                    <img src="https://image.flaticon.com/icons/svg/1721/1721997.svg" >
                    <span class="feedhome-like">{{$data->postLike}} </span>
                </div>

            </div> 
            <img src="{{$data->postDraw}}" class="feedhome-draw">
        </div>

        @endforeach
        <a href="/top" style="font-size: 18px;text-align: right;display: block;font-weight: bold;color: #1998cc;margin:15px 20px">more</a>
    </div>
    <h1 style="
        font-size: 20px;
        margin: 0px;
        border-bottom: 1px solid rgba(0,0,0,.15)!important;
        padding: 30px 15px 15px 15px;
        width: 100%;
        display: inline-block;
    ">For you</h1>
    <div>
        @foreach($shares as $data)
        <div class="feedhome">
            <a href="/feed/{{$data->tag->id}}">
                <div class="feedhome-tag">{{$data->tag->tagname}}</div> 
            </a>
            <a href="/story/{{$data->id}}">
                <div class="feedhome-title">{{$data->postName}}</div> 
                <div class="feedhome-post" :text-content.prop="'{{$data->post}}' | truncate" ></div>  
            </a>
            <div class="feedhome-text" >
                <a href="/profile/{{$data->user->id}}">
                    <div class="feedhome-name">
                        {{$data->user->name}}  
                    </div>
                </a>
                <div class="feedhome-time">

                    <span class="feedhome-time-into"  :text-content.prop="{{$data->postTime}} | timeSince" ></span>
                    
                    <img src="https://image.flaticon.com/icons/svg/1721/1721997.svg" >
                    <span class="feedhome-like">{{$data->postLike}} </span>
                </div>

            </div> 
            <img src="{{$data->postDraw}}" class="feedhome-draw">
        </div>
        @endforeach
    </div>
    <h1 style="
        font-size: 20px;
        margin: 0px;
        width: 100%;
        border-bottom: 1px solid rgba(0,0,0,.15)!important;
        padding: 40px 15px 15px 15px;
        display: inline-block;
    ">New</h1>
    <div>
        @foreach($news as $data)
        <div class="feedhome">
            <a href="/feed/{{$data->tag->id}}">
                <div class="feedhome-tag">{{$data->tag->tagname}}</div> 
            </a>
            <a href="/story/{{$data->id}}">
                <div class="feedhome-title">{{$data->postName}}</div> 
                <div class="feedhome-post" :text-content.prop="'{{$data->post}}' | truncate" ></div>  
            </a>
            <div class="feedhome-text" >
                <a href="/profile/{{$data->user->id}}">
                    <div class="feedhome-name">
                        {{$data->user->name}}  
                    </div>
                </a>
                <div class="feedhome-time">

                    <span class="feedhome-time-into"  :text-content.prop="{{$data->postTime}} | timeSince" ></span>
                    
                    <img src="https://image.flaticon.com/icons/svg/1721/1721997.svg" >
                    <span class="feedhome-like">{{$data->postLike}} </span>
                </div>

            </div> 
            <img src="{{$data->postDraw}}" class="feedhome-draw">
        </div>
        @endforeach
        <a href="/new" style="font-size: 18px;text-align:right;display: block;font-weight: bold;color: #1998cc;margin:15px 20px">more</a>
    </div>
@stop

@section('vuefeed')
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
                onOff:false,
            },
            computed: {
                // slice the array of data to display
                sliced() {
                return this.items.slice(0, this.display);
                },
            },
            methods: {
                // check to see if we're at the bottom of the page
                scroll() {
                window.onscroll = ev => {
                    if (
                        window.innerHeight + window.scrollY >=
                        (document.body.offsetHeight - this.trigger)
                    ) {
                        if (this.display < this.items.length) {
                            this.display = this.display + this.offset;
                            let vm = this;
                        }
                        else {
                            this.end = true;
                        }
                    }
                };
                },
                // preform API request to the server
                fetch() {
                    this.show = true;
                },

            },
            mounted() {
                // track scroll event
                this.end = true;
                let vm = this;
                this.scroll();
            },
            created() {
                // get the data by performing API request
                this.fetch();
            }
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
@stop